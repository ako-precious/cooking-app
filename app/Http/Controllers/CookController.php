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
        // Create a new row in your table
        $newCook = Cook::create([
            'user_id' => $request->user_id
            // Add any necessary attributes here
        ]);

        // Return the ID of the newly created row
        return response()->json(['id' => $newCook]);
    }
}
