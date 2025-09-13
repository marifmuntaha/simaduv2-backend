<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        try {
            if ($request->user('sanctum')->role == 1) {
                $notifications = DatabaseNotification::orderBy('updated_at', 'desc')->limit(10)->get();
            } else {
                $notifications = auth()->user()->notifications();
            }
            return response([
                'result' => $notifications,
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
