<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

use function Laravel\Prompts\error;

class AuthController extends Controller
{

    public function register(Request $request){
        // 1. Validator
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:8'
        ]);

        // 2. Cek Validator
        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        // 3. Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // 4. Response Success
        if ($user){
            return response()->json([
                'succes' => true,
                'message' => 'User created successfully',
                'data' => $user
            ]);
        }

        // 5. Response Fails
        return response()->json([
            'success' => false,
            'messsage' => 'User Creation Failed'
        ], 409); // Conflict

    }

    public function login(Request $request){
        // 1. Validator
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // 2. Cek Validator
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // 3. Get Kredential dari request
        $credentials = $request->only('email', 'password');

        // 4. Jika Gagal
        if (!$token = auth()->guard('api')->attempt($credentials)){
            return response()->json([
                'success' => false,
                'message' => 'Email atau password salah'
            ], 401);
        }

        // 5. Jika Sukses
        return response()->json([
            'success' => true,
            'message' => 'Berhasil Login',
            'user' => auth()->guard('api')->user(),
            'token' => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        // try
        // 1. Invalidate token
        // 2. cek isSuccess

        // catch
        // 1. cek isFailed

        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'success' => true,
                'message' => 'Logout successfully!'
            ], 200);
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Logout failed!'
            ], 500);
        }
    }
}
