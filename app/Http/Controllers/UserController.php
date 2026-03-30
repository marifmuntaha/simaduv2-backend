<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Throwable;

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
            return response()->success(UserResource::collection($users));
        } catch (Exception $e) {
            return response()->error($e->getMessage(), 500);
        }
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $user = User::create($request->validated());
            if (!$request->isNotFilled('institution')) {
                $institution = collect($request->institution)->map(function ($item) {
                    return $item['id'];
                });
                $user->institutions()->attach($institution);
            }
            return response()->success(new UserResource($user), 'Data Pengguna berhasil ditambahkan', 201);
        } catch (Throwable $th) {
            return response()->error($th, $th->getCode());
        }
    }

    public function show(User $user)
    {
        try {
            return response()->success(new UserResource($user));
        } catch (Throwable $th) {
            return response()->error($th, 500);
        }
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $user->update(array_filter($request->validated()));
            return response()->success(new UserResource($user), 'Data Pengguna berhasil disimpan');
        } catch (Throwable $th) {
            return response()->error($th, $th->getCode());
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->institutions()->detach();
            $user->delete();
            return response()->success(new UserResource($user), 'Data Pengguna berhasil dihapus');
        } catch (Throwable $th) {
            return response()->error($th, $th->getCode());
        }
    }
}
