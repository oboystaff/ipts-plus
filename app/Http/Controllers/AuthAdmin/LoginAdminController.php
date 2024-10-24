<?php

namespace App\Http\Controllers\AuthAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginAdminRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerType;


class LoginAdminController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function register()
    {
        $customerTypes = CustomerType::get();

        return view('auth.register', compact('customerTypes'));
    }


    public function login(LoginAdminRequest $request)
    {
        $data = $request->validated();

        if (stripos($data['username'], 'ERMS') === 0 && strpos($data['username'], '@') === false) {
            $data['username'] .= '@erms.com';
        }

        $result = filter_var($data['username'], FILTER_VALIDATE_EMAIL);

        if (stripos($data['username'], 'ERMS') === 0 && strpos($data['username'], '@erms.com') !== false) {
            $data['username'] = str_replace('@erms.com', '', $data['username']);
        }

        if (empty($result)) {
            if (!auth()->attempt([
                'phone' => $data['username'],
                'password' => $data['password'],
                'status' => 'Active'
            ])) {
                throw ValidationException::withMessages([
                    'username' => 'Your provided credentials could not be verified.'
                ]);
            }
        }

        if (!empty($result)) {
            if (!auth()->attempt([
                'email' => $data['username'],
                'password' => $data['password'],
                'status' => 'Active'
            ])) {
                throw ValidationException::withMessages([
                    'username' => 'Your provided credentials could not be verified.'
                ]);
            }
        }

        session()->regenerate();
        return redirect()->route('dashboard.operational');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('auth.index');
    }
}
