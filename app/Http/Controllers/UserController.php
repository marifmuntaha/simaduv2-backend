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
            return response([
                'result' => UserResource::collection(User::all()),
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function store(StoreUserRequest $request)
    {
        try {
            return ($user = User::create($request->all()))
                ? response([
                    'message' => 'User created successfully.',
                    'result' => new UserResource($user),
                ], 201) : throw new Exception("Failed to create User");
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function show(User $user)
    {
        try {
            return response([
                'result' => new UserResource($user),
            ]);
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            return ($user->update(array_filter($request->all())))
                ? response([
                    'message' => 'User updated successfully.',
                    'result' => new UserResource($user),
                ]) : throw new Exception("Failed to update User");
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function destroy(User $user)
    {
        try {
            return ($user->delete())
                ? response([
                    'message' => 'User deleted successfully.',
                ]) : throw new Exception("Failed to delete User");
        } catch (Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
