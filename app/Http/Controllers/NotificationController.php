<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notifications = Notification::where('user_id', $user->id)->latest()->paginate(4);
        return inertia('Notification', ['notifications' => $notifications]);
    }

    public function show($id)
    {

        $user_id =   Auth::id();
        $count = Notification::where('user_id', $user_id)->where('status', 'unread')->count();


        return response()->json(['count' => $count]);
    }
    public function update(Request $request){

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
    public function updateStatus(Request $request)
    {
        // Get the rows to update\
    }
    public function destroy($id)
    {
        $Notification = Notification::find($id);
        $Notification->delete();
       
            return response()->json(['message' => 'Notification removed successfully!','pending' => $Notification ]);
        
    }

}
