<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\User\CreateUserRequest;
use App\Http\Requests\API\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = User::orderBy('created_at', 'DESC')
            ->with(['assembly', 'division'])
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        return response()->json([
            'message' => 'Get all users',
            'data' => $data
        ]);
    }

    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['password'] = Hash::make($data['password']);
        $data['status'] = 'Active';

        $user = User::create($data);

        $role = Role::where('name', 'like', '%customer%')->first();

        if ($role) {
            $user->roles()->sync($role->id);
        }

        return response()->json([
            'message' => 'User created successfully',
            'data' => $user
        ]);
    }

    public function show($id)
    {
        $user = User::query()
            ->with(['assembly', 'division'])
            ->where('id', $id)
            ->first();

        if (empty($user)) {
            return response()->json([
                'message' => 'User not found'
            ], 422);
        }

        return response()->json([
            'message' => 'Get particular user',
            'data' => $user
        ]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->validated();

        $user = User::query()
            ->with(['assembly', 'division'])
            ->where('id', $id)
            ->first();

        if (empty($user)) {
            return response()->json([
                'message' => 'User not found'
            ], 422);
        }

        if (empty($request->validated('password'))) {
            $data['password'] = $user->password;
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return response()->json([
            'message' => 'User updated successfully'
        ]);
    }
}
