<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return inertia('Notification');
    }

    public function show()
    {

        $user_id =   Auth::id();
        $notifications = Notification::where('user_id', $user_id)->latest()->paginate(4);
        $count = Notification::where('user_id', $user_id)->where('status', 'unread')->count();


        return response()->json(['notifications' => $notifications, 'count' => $count]);
    }
    public function update(Request $request)
    {

        $user = Auth::user();
        $rows = Notification::where('user_id', $user->id)->get();

        // Update the status of the rows
        foreach ($rows as $row) {
            $row->status = $request->input('status');
            $row->save();
        }

        return response()->json(['message' => 'Rows updated successfully']);
    }
    // In your Laravel API controller

    public function destroy($id)
    {
        $Notification = Notification::find($id);
        $Notification->delete();
        $user = Auth::user();
        $notifications = Notification::where('user_id', $user->id)->latest()->paginate(4);

        return response()->json(['message' => 'Notification removed successfully!', 'notifications' => $notifications]);
    }
}
