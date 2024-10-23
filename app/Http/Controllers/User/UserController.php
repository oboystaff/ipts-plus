<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\Assembly;
use App\Models\Division;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }

    public function index(Request $request)
    {
        if (!auth()->user()->can('users.view')) {
            abort(403, 'Unauthorized action.');
        }

        $users = User::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->when($request->display == "agent", function ($query) {
                $query->where('access_level', 'Assembly_Agent');
            })
            ->when($request->display == "active", function ($query) {
                $query->where('access_level', 'Assembly_Agent')
                    ->where('status', 'Active');
            })
            ->when($request->display == "inactive", function ($query) {
                $query->where('access_level', 'Assembly_Agent')
                    ->where('status', 'InActive');
            })
            ->get();

        $roles = Role::orderBy('name', 'ASC')->get();

        foreach ($users as $user) {
            if (stripos($user->email, 'ERMS') === 0 && strpos($user->email, '@') === false) {
                $user->email .= '@erms.com';
            }
        }

        return view('users.index', compact('users', 'roles'));
    }

    public function create(Request $request)
    {
        if (!auth()->user()->can('users.create')) {
            abort(403, 'Unauthorized action.');
        }

        $assemblies = Assembly::query()
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        $divisions = Division::query()
            ->when(!empty($request->user()->assembly_code), function ($query) use ($request) {
                $query->where('assembly_code', $request->user()->assembly_code);
            })
            ->get();

        $roles = Role::orderBy('name', 'ASC')->get();

        return view('users.create', compact('assemblies', 'divisions', 'roles'));
    }

    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        $user->roles()->sync($request->validated('role'));

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function show(User $user)
    {
        return view('users.show')->with([
            'user' => $user,
        ]);
    }

    public function edit(User $user, Request $request)
    {
        if (!auth()->user()->can('users.update')) {
            abort(403, 'Unauthorized action.');
        }

        $roles = Role::orderBy('name', 'ASC')->get();
        $assemblies = Assembly::get();
        $divisions = Division::get();

        return view('users.edit')->with([
            'user' => $user,
            'roles' => $roles,
            'assemblies' => $assemblies,
            'divisions' => $divisions,
            'userRole' => $user->roles()->pluck('id')->toArray(),
        ]);
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $data = $request->validated();

            if (empty($request->validated('password'))) {
                $data['password'] = $user->password;
            } else {
                $data['password'] = Hash::make($data['password']);
            }

            $user->update($data);

            $user->roles()->sync($request->validated('role'));

            return redirect()->route('users.index')->with('status', 'User updated successfully.');
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
