<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Traits\ResponseJsonTrait;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    use ResponseJsonTrait;

    public function register(RegisterRequest $request)
    {
        $validated = $request->all();
        $data = [];
        foreach ($validated as $key => $value) {
            $data[$key] = $value;
            if($key == 'password'){
                $data[$key] = Hash::make($value);
            }
        }

        $user = User::create($data);
        $token = $user->createToken('rest-api-trip')->plainTextToken;
        $response['message'] = 'Successfully create user';
        $response['user'] = $user;
        $response['token'] = $token;


        return $this->success($response);
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->all();
        $user = User::where('email', $validated['email'])->first();
        if(!$user || !Hash::check($validated['password'], $user->password)){
            return $this->fail(['message' => 'Check your email and password']);
        }

        $token = $user->createToken('rest-api-trip')->plainTextToken;
        $response['message'] = 'Logged in Successfully';
        $response['user'] = $user;
        $response['token'] = $token;


        return $this->success($response);
    }

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return $this->success(['message' => 'logged out successfully']);
    }
}
