<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request){
        try {
            $validateUser = Validator::make($request->all(), [
                'email' => ['required', 'string', 'email'],
                'password' => ['required', 'string', 'min:8'],
            ]);

            if ($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'Dữ liệu không hợp lệ.',
                    'error' => $validateUser->errors()
                ],401);
            }
            if (!Auth::attempt($request->only(['email','password']))){
                return response()->json([
                    'status' => false,
                    'message' => 'Email & mật khẩu không đúng.',
                ],401);
            }
            $user = User::where('email',$request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'Đăng nhập thành công.',
                'token' => $user->createToken('API TOKEN')->plainTextToken
            ],200);

        }catch (\Throwable $e){
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ],500);
        }
    }
}
