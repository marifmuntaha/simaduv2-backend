<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoginRequest;
use App\Http\Requests\StorePasswordRequest;
use App\Http\Resources\UserResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(StoreLoginRequest $request)
    {
        try {
            if (Auth::attempt($request->only(['username', 'password']))) {
                $user = Auth::user();
                return response()->success([
                    'user' => $user->toArray(),
                    'token' => $user->createToken($request->user()->email)->plainTextToken,
                ], 'Berhasil masuk, anda akan dialihkan dalam 2 detik.');
            } else {
                throw new Exception('Nama pengguna/kata sandi salah.', 401);
            }
        } catch (Exception $e) {
            return response()->error($e->getMessage(), $e->getCode());
        }
    }

    public function forgetPassword(Request $request)
    {
        try {
            return ($request->username == 'admin')
                ? response([
                    'message' => 'Reset password Success',
                    'result' => [
                        'token' => fake()->uuid(),
                    ]
                ]) : throw new Exception('Reset password Failed');
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function resetPassword(StorePasswordRequest $request)
    {
        try {
            return ($request->email == 'marifmuntaha@gmail.com' && $request->token == 'a3ca7c56-abaa-3154-9550-27bb7bf2189b')
                ? response([
                    'message' => 'Reset password Success',
                ]) : throw new Exception('Reset password Failed');
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function logout(Request $request)
    {
        try {
            return ($status = $request->user('sanctum')->currentAccessToken()->delete())
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Berhasil keluar.',
                    'statusCode' => 200,
                ]) : throw new Exception(__($status));
        } catch (Exception $exception) {
            return response([
                'status' => 'error',
                'statusMessage' => $exception->getMessage(),
                'statusCode' => $exception->getCode(),
            ]);
        }
    }

    public function profile(Request $request)
    {
        try {
            $request->merge(['type' => 'profile']);
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'result' => new UserResource($request->user('sanctum')),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
            ], 401);
        }
    }
}
