<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = Admin::where('username', $request->username)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['code' => 404, "message" => "User Not Found", 'errors' => ['The provided credentials are incorrect.']]);
        }

        return response()->json(['code' => 200, "message" => "User Found", 'access_token' => $user->createToken($request->device_name)->plainTextToken]);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['code' => 200, "message" => "Logout Success"]);
    }
}
