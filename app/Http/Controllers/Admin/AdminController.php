<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class AdminController extends Controller
{
    // Login
    public function login(Request $request) {
        if ($request->isMethod('post')) {
            $data = $request->all();

            // echo "<pre>"; print_r($data); die;

            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required'
            ];

            $customMsg = [
                'email.required' => 'Email is required!',
                'password.required' => 'Password is required!'
            ];

            $request->validate($rules, $customMsg);

            if (Auth::guard('admin')->attempt(['email'=>$data['email'], 'password'=>$data['password']])) {
                // Set cookies
                if (!empty($data['rememberMe']) && $data['rememberMe'] == 'on') {
                    setcookie("email", $data['email'], time()+3600);
                    setcookie("password", $data['password'], time()+3600);
                } else {
                    setcookie("email", "");
                    setcookie("password", "");
                }

                return redirect('admin/dashboard');
            }

            return redirect()->back()->with('error_message', 'Invalid email or password');
        }

        return view('admin.login');
    }

    // Logout
    public function logout() {
        Auth::guard('admin')->logout();

        return redirect('admin/login');
    }

    // Dashboard
    public function dashboard() {
        return view('admin.dashboard');
    }
}
