<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Cook;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::id();
        $accounts = Cook::with('user')->get();;
       
        if ($user == '1') {
          
            # code...
            return inertia('Admin/Index', ['accounts' => $accounts]);
        }else{
            redirect('/');
        }
    }
}
