<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cook;

class CookController extends Controller
{
    public function setup()
    {
        // dd(Auth::id()) ;
        return inertia('Cook/setup',);
    }

    public function store(Request $request)
    {
        $user_id = $request->user_id;
        $user =  Cook::firstWhere('user_id', $user_id)->exists();
        if ($user) {
            // User exists
            $newCook = Cook::where('user_id', $user_id)->get();
        } else {
            // User does not exist
            $newCook = Cook::create($request->all());
        }
        // Create a new row in your table
        // Return the ID of the newly created row
        return response()->json(['data' => $newCook]);
    }
}
