<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use Exception;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        try {
            if ($request->user('sanctum')->id == 1) {
                $notifications = Notification::all();
            } else {
                $notifications = Notification::whereHas('user', function ($query) use ($request) {
                    return $query->where('user_id', $request->user('sanctum')->id);
                })->get();
            }
            return response([
                'result' => NotificationResource::collection($notifications),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, Notification $notification)
    {

    }
}
