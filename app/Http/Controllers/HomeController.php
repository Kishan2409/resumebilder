<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Hero;
use App\Models\Skills;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('main');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $email)
    {
        //

        $user = User::where('email', $email)->first();
        $hero = Hero::where('added_by', $user->id)->first();
        $about = About::where('added_by', $user->id)->first();
        $skill = Skills::where('about_id', $about->id)->get();
        $education = Education::where('about_id', $about->id)->get();
        $experience = Experience::where('added_by', $user->id)->where('status', '1')->get();
        return view('main', compact('hero', 'about', 'skill', 'education', 'experience'));
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
