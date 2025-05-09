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
use App\Models\GhanaRegion;

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

        $userQuery = User::orderBy('created_at', 'DESC')
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->where('regional_code', $request->user()->regional_code);
            })
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
            });


        $users = $userQuery->get();

        $roles = Role::orderBy('name', 'ASC')->get();

        $totalActiveUsers = (clone $userQuery)->where('status', 'Active')->count();
        $totalInactiveUsers = (clone $userQuery)->where('status', 'InActive')->count();
        $totalMaleUsers = (clone $userQuery)->where('gender', 'Male')->count();
        $totalFemaleUsers = (clone $userQuery)->where('gender', 'Female')->count();

        foreach ($users as $user) {
            if (stripos($user->email, 'ERMS') === 0 && strpos($user->email, '@') === false) {
                $user->email .= '@erms.com';
            }
        }

        $total = [
            'totalActiveUsers' => isset($totalActiveUsers) ? $totalActiveUsers : 0,
            'totalInactiveUsers' => isset($totalInactiveUsers) ? $totalInactiveUsers : 0,
            'totalMaleUsers' => isset($totalMaleUsers) ? $totalMaleUsers : 0,
            'totalFemaleUsers' => isset($totalFemaleUsers) ? $totalFemaleUsers : 0
        ];

        return view('users.index', compact('users', 'roles', 'total'));
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

        $regions = GhanaRegion::orderBy('name', 'ASC')
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->where('regional_code', $request->user()->regional_code);
            })
            ->get();

        if ($request->user()->access_level === "Super_User") {
            $roles = Role::query()
                ->orderBy('name', 'ASC')
                ->get();
        } else {
            $roles = Role::whereRaw('LOWER(name) NOT IN (?, ?, ?)', ['administrator', 'gra', 'gog'])
                ->orderBy('name', 'ASC')
                ->get();
        }

        return view('users.create', compact('assemblies', 'divisions', 'roles', 'regions'));
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

        if ($request->user()->access_level === "Super_User") {
            $roles = Role::query()
                ->orderBy('name', 'ASC')
                ->get();
        } else {
            $roles = Role::whereRaw('LOWER(name) NOT IN (?, ?, ?)', ['administrator', 'gra', 'gog'])
                ->orderBy('name', 'ASC')
                ->get();
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

        $regions = GhanaRegion::orderBy('name', 'ASC')
            ->when(!empty($request->user()->regional_code), function ($query) use ($request) {
                $query->where('regional_code', $request->user()->regional_code);
            })
            ->get();

        return view('users.edit')->with([
            'user' => $user,
            'roles' => $roles,
            'assemblies' => $assemblies,
            'divisions' => $divisions,
            'userRole' => $user->roles()->pluck('id')->toArray(),
            'regions' => $regions
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
