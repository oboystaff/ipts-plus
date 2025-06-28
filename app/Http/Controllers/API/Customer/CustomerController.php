<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Customer\CreateCustomerRequest;
use App\Http\Requests\API\Customer\UpdateCustomerRequest;
use App\Models\Citizen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Jobs\Registration\SendRegistrationReminder;
use App\Models\Property;

class CustomerController extends Controller
{
    public function index()
    {
        $data = Citizen::orderBy('created_at', 'DESC')
            ->get();

        return response()->json([
            'message' => 'Get all customers',
            'data' => $data
        ]);
    }

    public function store(CreateCustomerRequest $request)
    {
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
        $userData = [];

        if (empty($user)) {
            $userData = User::create($userLoginData);
        } else {
            $userData = $user;
        }

        $role = Role::where('name', 'like', '%customer%')->first();

        if ($role) {
            $userData->roles()->sync($role->id);
        }

        $data['user_id'] = $userData->id;

        if (!empty($userData)) {
            $customer = Citizen::create($data);
        }

        dispatch(new SendRegistrationReminder($customer));

        return response()->json([
            'message' => 'Customer created successfully',
            'data' => $customer
        ]);
    }

    public function frontstore(CreateCustomerRequest $request)
    {
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
        $userData = [];

        if (empty($user)) {
            $userData = User::create($userLoginData);
        } else {
            $userData = $user;
        }

        $role = Role::where('name', 'like', '%customer%')->first();

        if ($role) {
            $userData->roles()->sync($role->id);
        }

        $data['user_id'] = $userData->id;

        if (!empty($userData)) {
            $customer = Citizen::create($data);
        }

        dispatch(new SendRegistrationReminder($customer));

        return response()->json([
            'message' => 'Customer created successfully',
            'data' => $customer
        ]);
    }

    public function show($id)
    {
        $customer = Citizen::where('user_id', $id)
            ->orWhere('account_number', $id)
            ->first();

        if (empty($customer)) {
            return response()->json([
                'message' => 'Customer not found'
            ], 422);
        }

        return response()->json([
            'message' => 'Get particular customer',
            'data' => $customer
        ]);
    }

    public function multipleParam($id)
    {
        $customer = Citizen::with(['user', 'properties'])
            ->where(function ($query) use ($id) {
                $query->where('user_id', $id)
                    ->orWhere('account_number', $id)
                    ->orWhere('first_name', 'like', "%$id%")
                    ->orWhere('last_name', 'like', "%$id%")
                    ->orWhere('telephone_number', $id)
                    ->orWhere('ghana_card_number', $id);
            })->get();

        if (count($customer) == 0) {
            return response()->json([
                'message' => 'Customer not found'
            ], 422);
        }

        return response()->json([
            'message' => 'Get particular customer',
            'data' => $customer
        ]);
    }

    public function update(UpdateCustomerRequest $request, $id)
    {
        $customer = Citizen::where('user_id', $id)
            ->orWhere('account_number', $id)
            ->first();

        if (empty($customer)) {
            return response()->json([
                'message' => 'Customer not found'
            ], 422);
        }

        $customer->update($request->validated());

        $user = User::where('id', $customer->user_id)
            ->with(['customer'])
            ->first();

        return response()->json([
            'message' => 'Customer updated successfully',
            'data' => $user
        ]);
    }

    public function globalSearch($id)
    {
        $customer = Citizen::with(['properties.bills.payments'])
            ->where(function ($query) use ($id) {
                $query->where('user_id', $id)
                    ->orWhere('account_number', $id)
                    ->orWhere('first_name', 'LIKE', "%$id%")
                    ->orWhere('last_name', 'LIKE', "%$id%")
                    ->orWhere('telephone_number', $id)
                    ->orWhere('ghana_card_number', $id);
            })
            ->get();

        $property = Property::with([
            'customer' => function ($query) {
                $query->select(
                    'id',
                    'user_id',
                    'first_name',
                    'last_name',
                    'account_number',
                    'telephone_number',
                    'Ghana_card_number'
                );
            },
            'bills.payments'
        ])
            ->where(function ($query) use ($id) {
                $query->where('property_number', $id)
                    ->orWhere('digital_address', $id)
                    ->orWhere('street_name', 'LIKE', "%$id%")
                    ->orWhere('location', 'LIKE', "%$id%");
            })
            ->get();

        $customerProperties = $customer->flatMap(function ($citizen) {
            return $citizen->properties;
        });

        $allProperties = $property->concat($customerProperties)->unique('id')->values();

        $propertyCustomers = $property->map(function ($prop) {
            return $prop->customer;
        })->filter()->unique('id')->values();

        $allCustomers = $customer->concat($propertyCustomers)->unique('id')->values();

        if ($allCustomers->isEmpty() && $allProperties->isEmpty()) {
            return response()->json([
                'message' => 'No record found for this customer/property'
            ], 422);
        }

        return response()->json([
            'message' => 'Get customer and property details',
            'data' => [
                'customers' => $allCustomers,
                'properties' => $allProperties
            ]
        ]);
    }
}
