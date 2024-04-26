<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        $user = Auth::user();
        $notifications = Notification::where('user_id',$user->id)->latest()->paginate(4);
        return inertia('Notification', [ 'notifications' => $notifications]);
    }
    
    public function show($id){
        
        $user_id =   Auth::id();
        $count = Notification::where('user_id',$user_id)->where('status', 'unread')->count();

       
            return response()->json([ 'count' => $count]);
        
    }
}
