<?php

namespace App\Http\Controllers\Role;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function index()
    {
        if (!auth()->user()->can('roles.view')) {
            abort(403, 'Unauthorized action.');
        }

        $roles = Role::orderBy('created_at', 'DESC')->get();

        return view('roles.index')->with([
            'roles' => $roles
        ]);
    }

    public function create()
    {
        if (!auth()->user()->can('roles.create')) {
            abort(403, 'Unauthorized action.');
        }

        return view('roles.create');
    }

    public function store(CreateRoleRequest $request)
    {
        try {

            Role::create($request->validated());

            return redirect()->route('roles.index')->with('status', 'Role created successfully.');
        } catch (\Exception $ex) {
        }
    }

    public function show(Role $role)
    {
        return view('roles.show')->with([
            'role' => $role
        ]);
    }

    public function edit(Role $role)
    {
        if (!auth()->user()->can('roles.update')) {
            abort(403, 'Unauthorized action.');
        }

        return view('roles.edit')->with([
            'role' => $role
        ]);
    }

    public function update(UpdateRoleRequest $request, Role $role)
    {
        try {
            $role->update($request->validated());

            return redirect()->route('roles.index')->with('status', 'Role updated successfully.');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
