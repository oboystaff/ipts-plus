<?php

namespace App\Http\Controllers\Citizens;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CreateCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Jobs\Registration\SendRegistrationReminder;
use Illuminate\Http\Request;
use App\Models\Citizen;
use App\Models\CustomerType;
use App\Models\User;
use App\Models\Assembly;
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

            return redirect()->route('auth.index')->with('status', 'Citizen created successfully!');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }

    // Display the specified resource.
    public function show(Citizen $citizen)
    {
        return view('citizens.show', compact('citizen'));
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
