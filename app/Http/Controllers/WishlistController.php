<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $wishlists = Wishlist::where('user_id', $user->id)->get();
    //    dd($accounts);
        return inertia('wishlist',['wishlist' => $wishlists] );
    }

    
    public function store(Request $request)
    {
        $new_Wishlist = Wishlist::create($request->all());
        // dd($new_Wishlist);

                  $new_Wishlist->save();
        

        return response()->json([
            'data' => $new_Wishlist,
            'message' => 'Successfully added a new Meal Schedule!',
            // 'status' => Response::HTTP_CREATED
        ]);
    }
}
