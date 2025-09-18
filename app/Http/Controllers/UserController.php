<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        try {
            $users = new User();
            if ($request->has('username')) {
                $users = $users->where('username', $request->username)->get();
            }
            else {
                $users = $users->get();
            }
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => UserResource::collection($users),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function store(StoreUserRequest $request)
    {
        try {
            return ($user = User::create($request->all()))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Pengguna berhasil ditambahkan',
                    'statusCode' => 201,
                    'result' => new UserResource($user),
                ], 201) : throw new Exception("Data Pengguna gagal ditambahkan", 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function show(User $user)
    {
        try {
            return response([
                'status' => 'success',
                'statusMessage' => '',
                'statusCode' => 200,
                'result' => new UserResource($user),
            ]);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            return ($user->update(array_filter($request->all())))
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Pengguna berhasil disimpan',
                    'statusCode' => 200,
                    'result' => new UserResource($user),
                ]) : throw new Exception("Data Pengguna gagal disimpan", 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }

    public function destroy(User $user)
    {
        try {
            return ($user->delete())
                ? response([
                    'status' => 'success',
                    'statusMessage' => 'Data Pengguna berhasil dihapus',
                    'statusCode' => 200,
                ]) : throw new Exception("Data Pengguna gagal dihapus", 422);
        } catch (Exception $e) {
            return response([
                'status' => 'error',
                'statusMessage' => $e->getMessage(),
                'statusCode' => $e->getCode(),
            ]);
        }
    }
}
