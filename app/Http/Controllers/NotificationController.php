<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notification()
    {
        $user = Auth::user();
        $notifications = Notification::where('user_id', $user->id)->latest()->paginate(4);
        return inertia('Notification', ['notifications' => $notifications]);
    }
    public function index()
    {
       
            $user_id =   Auth::id();
            $notifications = Notification::where('user_id', $user_id)->latest()->paginate(4);
            $count = Notification::where('user_id', $user_id)->where('status', 'unread')->count();
            $prevPageUrl = $notifications->previousPageUrl();
            $nextPageUrl = $notifications->nextPageUrl();
        //    dd( $nextPageUrl);

            return response()->json([
                'notifications' => $notifications,
                'count' => $count,
                'prev_page_url' => $prevPageUrl,
                'next_page_url' => $nextPageUrl,
                '$user_id' => $user_id,
            ]);
   
    }

    public function show()
    {

        $user_id =   Auth::id();
        $notifications = Notification::where('user_id', $user_id)->latest()->paginate(4);
        $count = Notification::where('user_id', $user_id)->where('status', 'unread')->count();
        $prevPageUrl = $notifications->previousPageUrl();
        $nextPageUrl = $notifications->nextPageUrl();
       dd( $nextPageUrl);
        return response()->json([
            'notifications' => $notifications,
            'count' => $count,
            'prev_page_url' => $prevPageUrl,
            'next_page_url' => $nextPageUrl,
        ]);
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
