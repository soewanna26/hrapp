<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAuthRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function authenticate(AdminAuthRequest $request)
    {
        $identifier = $request->identifier();
        $password = $request->password;

        if (Auth::attempt([$identifier => $request->identifier, 'password' => $password], $request->get('remember'))) {
            $admin = Auth::user();
            if ($admin == Auth::user()) {
                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout();
                return redirect()->route('admin.login')->with('error', "You are not authorized to access admin panel.");
            }
        }

        return redirect()->route('admin.login')->with('error', 'Either Email or Password is incorrect');
    }

    public function register()
    {
        return view('admin.register');
    }

    public function registeration(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|numeric|unique:users,phone',
            'email' => 'required|email|unique:users,email',
        ], [
            'name.required' => 'The name field is required.',
            'phone.required' => 'The phone field is required.',
            'phone.numeric' => 'The phone field must be number only.',
            'phone.unique' => 'This phone number is already registered.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email address is already registered.',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        Auth::login($user);

        return redirect()->route('admin.dashboard');
    }
}
