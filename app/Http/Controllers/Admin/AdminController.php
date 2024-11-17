<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;
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

            return redirect()->back()->with('error_message', 'Invalid email or password.');
        }

        return view('admin.login');
    }

    // Logout
    public function logout() {
        Auth::guard('admin')->logout();

        return redirect('admin/login');
    }

    // Update Password
    public function updatePassword(Request $request) {
        if ($request->isMethod("post")) {
            $data = $request->input();

            // Check Current Password
            if (Hash::check($data["currPassword"], Auth::guard("admin")->user()->password)) {
                // Check New & Confirm Password
                if ($data["newPassword"] == $data["confirmPassword"]) {
                    Admin::where("email", Auth::guard("admin")->user()->email)->update([
                        "password" => bcrypt($data["newPassword"])
                    ]);

                    return redirect()->back()->with('success_message', 'Success to updating password.');
                } else {
                    return redirect()->back()->with('error_message', 'Your password is not match.');
                }
            } else {
                return redirect()->back()->with('error_message', 'Your current password is incorrect.');
            }
        }

        return view('admin.update_password');
    }

    // Check Current Password
    public function checkCurrPassword(Request $request) {
        $data = $request->all();

        if (Hash::check($data["curr_passwd"], Auth::guard("admin")->user()->password)) {
            $check = "valid";

            return $check;
        } else {
            $check = "wrong";

            return $check;
        }
    }

    // Update Admin Details
    public function updateAdminDetails(Request $request) {
        if ($request->isMethod("post")) {
            $data = $request->all();

            // echo "<pre>"; print_r($data); die;

            $rules = [
                "currName" => "required|alpha",
                "currMobilePhone" => "required|numeric",
                "adminImage" => "required|image|mimes:jpg,png,jpeg|max:2048",
            ];
            $customMsgs = [
                "currName.required" => "Name is required",
                "currMobilePhone.required" => "Mobile Phone is required",
                "adminImage.required" => "Mobile Phone is required",
                "currName.alpha" => "Name is not valid",
                "currMobilePhone.numeric" => "Mobile Phone is not valid",
                "adminImage.image" => "Image must be image file",
                "adminImage.mimes" => "Image only jpg, png, or jpeg",
            ];

            $request->validate($rules, $customMsgs);

            // Upload Image
            if ($request->hasFile("adminImage") && $request->file('adminImage')->isValid()) {
                $avatar = $request->file("adminImage");

                // Get Img Ext
                $ext = $avatar->getClientOriginalExtension();

                // Generate New Img Name
                $img_name = rand(111, 99999).".".$ext;

                // Read & Save Img
                $destinationPath = public_path("admin/img/photos/" . $img_name);
                Image::make(file_get_contents($avatar))->save($destinationPath);
            } else if (!empty($data["currImg"])) {
                $img_name = $data["currImg"];
            } else {
                $img_name = "";
            }

            // Update Admin Details
            Admin::where("email", Auth::guard("admin")->user()->email)->update([
                "name" => $data["currName"],
                "mobile" => $data["currMobilePhone"],
                "image" => $img_name
            ]);

            return redirect()->back()->with('success_message', 'Success to updating admin details.');
        }

        return view('admin.update_admin_details');
    }

    // Dashboard
    public function dashboard() {
        return view('admin.dashboard');
    }
}
