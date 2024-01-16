<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $id = auth()->user()->id;
        $data = Hero::where('added_by', $id)->first();
        return view('layouts.hero.index', compact('data'));
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
        $id = auth()->user()->id;
        $hero = Hero::where('added_by', $id)->first();

        if ($request->hasFile('pimage')) {
            $imageName = $request->file('pimage');
            $poster_image = rand(10000, 99999) . '.' . $imageName->getClientOriginalExtension();
            $imageName->move('public/storage/hero_poster/', $poster_image);
            if (!empty($hero->image)) {
                if (File::exists("public/storage/hero_poster/" . $hero->image)) {
                    File::delete("public/storage/hero_poster/" . $hero->image);
                }
            }
        } else {
            $poster_image = $hero->image;
        }

        if ($request->hasFile('resume')) {
            $resume = $request->file('resume');
            $poster_doc = rand(10000, 99999) . '.' . $resume->getClientOriginalExtension();
            $resume->move('public/storage/hero_doc/', $poster_doc);
            if (!empty($hero->doc)) {
                if (File::exists("public/storage/hero_doc/" . $hero->doc)) {
                    File::delete("public/storage/hero_doc/" . $hero->doc);
                }
            }
        } else {
            $poster_doc = $hero->doc;
        }

        if (!empty($hero)) {
            Hero::where('added_by', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'image' => $poster_image,
                'doc' => $poster_doc,
                'skills' => implode(', ', $request->skills)
            ]);
        } else {
            Hero::Create(
                [
                    'added_by' => $id,
                    'name' => $request->name,
                    'email' => $request->email,
                    'image' => $poster_image,
                    'doc' => $poster_doc,
                    'skills' => implode(', ', $request->skills)
                ]
            );
        }

        //redirect
        return redirect()->route('user.hero.index')->with('success', 'Hero Section Update Suceessfully !');
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
