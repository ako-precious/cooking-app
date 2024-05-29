<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
class NotificationController extends Controller
{
    public function notification()
    {
        $user = Auth::user();
        $notifications = Notification::where('user_id', $user->id)->latest()->paginate(6);
        return inertia('Notification', ['messages' => $notifications]);
    }
    public function index()
    {
       
            $user_id =   Auth::id();
            $notifications = Notification::where('user_id', $user_id)->latest()->paginate(6);
            $count = Notification::where('user_id', $user_id)->where('status', 'unread')->count();

            return response()->json([
                'notifications' => $notifications,
                'count' => $count,
                '$user_id' => $user_id,
            ]);
   
    }

    public function show()
    {

        $user_id =   Auth::id();
        $notifications = Notification::where('user_id', $user_id)->latest()->paginate(6);
        $count = Notification::where('user_id', $user_id)->where('status', 'unread')->count();
    
        return response()->json([
            'notifications' => $notifications,
            'count' => $count,
        ]);
    }
    public function updateStatus(): JsonResponse
    {
        $user = Auth::user();
        $rows = Notification::where('user_id', $user->id)->get();

        // Update the status of the rows
        foreach ($rows as $row) {
            $row->status = 'read';
            $row->save();
        }

        return response()->json(['message' => 'Rows updated successfully']);
    }
    
    public function update($id)
    {
        $row = Notification::find($id);

            $row->status = 'read';
            $row->save();        

        return response()->json(['message' => 'Rows updated successfully']);
    }
    // In your Laravel API controller

    public function destroy($id)
    {
        $Notification = Notification::find($id);
        $Notification->delete();
        $user = Auth::user();
        $notifications = Notification::where('user_id', $user->id)->latest()->paginate(6)
        ;

        return response()->json(['message' => 'Notification removed successfully!', 'notifications' => $notifications]);
    }
}
