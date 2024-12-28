<?php

namespace App\Http\Controllers;
use HTMLPurifier;
use HTMLPurifier_Config;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\Resource;
class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Resources/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config); 
    
        $sanitizedContent = $purifier->purify($request->input('content'));
    
       $resources= Resource::create([
            'title' => $request->input('title'),
            'user_id' => $request->input('user_id'),
            'content' => $sanitizedContent,
            'post_photo_path' => $request->input('post_photo_path'),
            'read_time' => $request->input('read_time'),
            'slug'=> $request->input('slug'),
            'useful' => $request->input('useful'),
            'useless' => $request->input('useless'),
        ]);
     
        return redirect()->route('resources.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
