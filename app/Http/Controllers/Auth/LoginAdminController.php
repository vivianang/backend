<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginAdminController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = Admin::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['code' => 404, "message" => "User Not Found", 'errors' => ['The provided credentials are incorrect.']]);
        }

        return response()->json(['code' => 200, "message" => "User Found", 'access_token' => $user->createToken($request->device_name)->plainTextToken]);
    }
}
