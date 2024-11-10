<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Login
    public function login() {
        return view('admin.login');
    }

    // Dashboard
    public function dashboard() {
        return view('admin.dashboard');
    }
}
