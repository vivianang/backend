<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = Pengguna::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json(['code' => 404, "message" => "User Not Found", 'errors' => ['The provided credentials are incorrect.']]);
        }

        $accessToken = $user->createToken($request->device_name)->plainTextToken;
        $id_penduduk = $user->id_pengguna;

        return response()->json(['code' => 200, "message" => "User Found", 'access_token' => $accessToken, 'id_penduduk' => $id_penduduk ]);
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(['code' => 200, "message" => "Logout Success"]);
    }
}
