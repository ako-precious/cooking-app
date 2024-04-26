<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        $user = Auth::user();
        $notifications = Notification::where('user_id',$user->id)->orderBy('created_at', 'desc')->latest()->paginate(12);
        return inertia('Notification', [ 'notifications' => $notifications]);
    }
    
}
