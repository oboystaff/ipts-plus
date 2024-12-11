<?php

namespace App\Http\Controllers\Citizens;

use App\Http\Controllers\Controller;
use App\Http\Requests\Activate\ActivateCitizenRequest;
use App\Http\Requests\Activate\ResendOTPRequest;
use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Jobs\Registration\SendRegistrationReminder;
use App\Jobs\OTP\SendOTPSMS;
use Illuminate\Http\Request;
use App\Models\Citizen;
use App\Models\Bill;
use App\Models\Payment;
use App\Models\Property;
use App\Models\Business;
use App\Models\CustomerType;
use App\Models\User;
use App\Models\OTP;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class CitizenController extends Controller
{
    public function index(Request $request)
    {
        if (!auth()->user()->can('customers.view')) {
            abort(403, 'Unauthorized action.');
        }

        $citizens = Citizen::orderBy('created_at', 'DESC')
            ->when($request->user()->access_level === 'Assembly_Administrator', function ($query) use ($request) {
                $assemblyCode = $request->user()->assembly_code;

                $query->where(function ($subQuery) use ($assemblyCode) {
                    $subQuery->whereHas('properties', function ($propertyQuery) use ($assemblyCode) {
                        $propertyQuery->where('assembly_code', $assemblyCode);
                    })
                        ->orWhereHas('businesses', function ($businessQuery) use ($assemblyCode) {
                            $businessQuery->where('assembly_code', $assemblyCode);
                        });
                });
            })
            ->get();

        return view('citizens.index', compact('citizens'));
    }

    // Show the form for creating a new resource.
    public function create(Request $request)
    {
        if (!auth()->user()->can('customers.create')) {
            abort(403, 'Unauthorized action.');
        }

        $customerTypes = CustomerType::get();

        return view('citizens.create', compact('customerTypes'));
    }

    // Store a newly created resource in storage.

    public function store(CreateCustomerRequest $request)
    {
        try {
            $data = $request->validated();

            $randomNumbers = '';
            for ($i = 0; $i < 6; $i++) {
                $randomNumbers .= mt_rand(0, 9);
            }

            // Generate unique account number
            do {
                $accountNumber = 'ERMS' . $randomNumbers;
            } while (Citizen::where('account_number', $accountNumber)->exists());

            $data['account_number'] = $accountNumber;
            $data['created_by'] = $request->user()->id;
            $data['status'] = 'Active';

            $userLoginData = [
                'name' => $data['first_name'] . ' ' . $data['last_name'],
                'email' => $data['account_number'],
                'phone' => $data['telephone_number'],
                'password' => Hash::make(env('DEFAULT_PASSWORD')),
                'access_level' => 'customer',
                'status' => 'Active'
            ];

            $user = User::where('phone', $data['telephone_number'])->first();
            if (!empty($user)) {
                return redirect()->route('citizens.create')->with('error', 'Phone number for user account already exist!');
            }

            $userData = User::create($userLoginData);
            $role = Role::where('name', 'like', '%customer%')->first();
            if ($role) {
                $userData->roles()->sync($role->id);
            }
            $data['user_id'] = $userData->id;

            if (!empty($userData)) {
                $customer = Citizen::create($data);
            }

            dispatch(new SendRegistrationReminder($customer));

            return redirect()->route('citizens.index')->with('status', 'Assembly customer created successfully!');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function frontstore(CreateCustomerRequest $request)
    {
        try {
            $data = $request->validated();

            $randomNumbers = '';
            for ($i = 0; $i < 6; $i++) {
                $randomNumbers .= mt_rand(0, 9);
            }

            // Generate unique account number
            do {
                $accountNumber = 'ERMS' . $randomNumbers;
            } while (Citizen::where('account_number', $accountNumber)->exists());

            $data['account_number'] = $accountNumber;
            $data['created_by'] = $request->user()->id ?? 'customer';
            $data['status'] = 'InActive';

            $userLoginData = [
                'name' => $data['first_name'] . ' ' . $data['last_name'],
                'email' => $data['account_number'],
                'phone' => $data['telephone_number'],
                'password' => Hash::make(env('DEFAULT_PASSWORD')),
                'access_level' => 'customer',
                'status' => 'InActive'
            ];

            $user = User::where('phone', $data['telephone_number'])->first();
            if (!empty($user)) {
                return redirect()->route('citizens.create')->with('error', 'Phone number for user account already exist!');
            }

            $userData = User::create($userLoginData);
            $role = Role::where('name', 'like', '%customer%')->first();
            if ($role) {
                $userData->roles()->sync($role->id);
            }
            $data['user_id'] = $userData->id;

            if (!empty($userData)) {
                $customer = Citizen::create($data);
            }

            dispatch(new SendRegistrationReminder($customer));
            dispatch(new SendOTPSMS($customer))->delay(now()->addSeconds(5));

            return redirect()->route('citizens.activate')->with('status', 'Citizen created successfully, kindly activate your account with the code sent to your phone.');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function activate()
    {
        return view('auth.activate');
    }

    public function activateCitizen(ActivateCitizenRequest $request)
    {
        $code = OTP::where('code', $request->code)->first();

        if (empty($code)) {
            return redirect()->route('citizens.activate')->with('error', 'The code entered is invalid try again!');
        }

        $customer = Citizen::where('id', $code->citizen_id)->first();

        if ($customer) {
            $user = User::where('id', $customer->user_id)->first();

            $customer->update(['status' => 'Active']);
            $user->update(['status' => 'Active']);

            dispatch(new SendRegistrationReminder($customer));
        }

        return redirect()->route('auth.index')->with('status', 'Account activated successfully');
    }

    public function resend()
    {
        return view('auth.resend');
    }

    public function resendOTP(ResendOTPRequest $request)
    {
        $customer = Citizen::where('telephone_number', $request->telephone_number)->first();

        if (empty($customer)) {
            return redirect()->route('citizens.resend')->with('error', 'Telephone number does not exist for any of the account!');
        }

        if ($customer) {
            dispatch(new SendOTPSMS($customer));
        }

        return redirect()->route('citizens.activate')->with('status', 'OTP resent successfully');
    }

    // Display the specified resource.
    public function show(Request $request, Citizen $citizen)
    {
        $bills = Bill::orderBy('created_at', 'DESC')
            ->with(['property', 'business'])
            ->where(function ($query) use ($citizen) {
                $query->whereHas('property', function ($q) use ($citizen) {
                    $q->where('customer_name',  $citizen->id);
                })
                    ->whereNotNull('property_id')
                    ->whereNull('business_id');
            })
            ->orWhere(function ($query) use ($citizen) {
                $query->whereHas('business', function ($q) use ($citizen) {
                    $q->where('citizen_account_number', $citizen->id);
                })
                    ->whereNotNull('business_id')
                    ->whereNull('property_id');
            })
            ->get();

        $payments = Payment::orderBy('created_at', 'DESC')
            ->whereHas('bill', function ($query) use ($citizen) {
                $query->whereHas('property', function ($propertyQuery) use ($citizen) {
                    $propertyQuery->where('customer_name', $citizen->id)
                        ->whereNotNull('property_id')
                        ->whereNull('business_id');
                })
                    ->orWhereHas('business', function ($businessQuery) use ($citizen) {
                        $businessQuery->where('citizen_account_number', $citizen->id)
                            ->whereNotNull('business_id')
                            ->whereNull('property_id');
                    });
            })
            ->get();

        $properties = Property::orderBy('created_at', 'DESC')
            ->where('customer_name', $citizen->id)
            ->get();

        $businesses = Business::orderBy('created_at', 'DESC')
            ->where('citizen_account_number', $citizen->id)
            ->get();

        $totalArrears = $bills->sum('arrears');
        $totalAmount = $bills->sum('amount');

        $customerData = [
            'properties' => isset($properties) ? $properties : [],
            'businesses' => isset($businesses) ? $businesses : [],
            'total' => isset($properties) ? number_format(collect($properties)->sum('ratable_value'), 2) : 0,
            'bills' => isset($bills) ? $bills : [],
            'payments' => isset($payments) ? $payments : [],
            'totalArrears' => isset($totalArrears) ? number_format($totalArrears, 2) : 0,
            'totalAmount' => isset($totalAmount) ? number_format($totalAmount, 2) : 0,
            'totalDue' => isset($totalArrears) && isset($totalAmount) ? number_format($totalArrears + $totalAmount, 2) : 0,
            'paymentTotal' => isset($payments) ? number_format(collect($payments)->sum('amount'), 2) : 0
        ];

        return view('citizens.show', compact('citizen', 'customerData'));
    }

    // Show the form for editing the specified resource.
    public function edit(Request $request, Citizen $citizen)
    {
        if (!auth()->user()->can('customers.update')) {
            abort(403, 'Unauthorized action.');
        }

        $customerTypes = CustomerType::get();

        return view('citizens.edit', compact('citizen', 'customerTypes'));
    }

    // Update the specified resource in storage.
    public function update(UpdateCustomerRequest $request, Citizen $citizen)
    {
        $citizen->update($request->validated());

        return redirect()->route('citizens.index')->with('status', 'Citizen updated successfully!');
    }

    // Remove the specified resource from storage.
    public function destroy($id)
    {
        $citizen = Citizen::findOrFail($id);
        $citizen->delete();

        return redirect()->route('citizens.index')->with('success', 'Citizen deleted successfully!');
    }
}
