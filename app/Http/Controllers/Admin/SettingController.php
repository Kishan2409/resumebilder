<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public $moduleName = "Web-Setting";
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $moduleName = $this->moduleName;
        $setting = Setting::first();
        return view('admin.websetting.index', compact('moduleName', 'setting'));
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
        $setting = Setting::where('id', 1)->first();
        //logo file
        if ($request->hasFile('logo')) {
            $imageName = $request->file('logo');
            $logo = rand(10000, 99999) . '.' . $imageName->getClientOriginalExtension();
            $imageName->move('public/storage/logo/', $logo);
            if (!empty($setting->logo)) {
                if (File::exists("public/storage/logo/" . $setting->logo)) {
                    File::delete("public/storage/logo/" . $setting->logo);
                }
            }
        } else {
            if (empty($setting->logo)) {
                $oldPath = asset('public/admin/dist/img/no_image_available.png'); // public/admin/dist/img/no_image_available.png
                $fileExtension = File::extension($oldPath);
                $logo = rand(10000, 99999) . "." . $fileExtension;
                $path = 'public/storage/logo/';
                $newPathWithName = $path . $logo;
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true); //creates directory
                }
                File::copy($oldPath, $newPathWithName);
            } else {
                $logo = $setting->logo;
            }
        }
        //favicon file
        if ($request->hasFile('favicon')) {
            $imageName = $request->file('favicon');
            $favicon = rand(10000, 99999) . '.' . $imageName->getClientOriginalExtension();
            $imageName->move('public/storage/favicon/', $favicon);
            if (!empty($setting->favicon)) {
                if (File::exists("public/storage/favicon/" . $setting->favicon)) {
                    File::delete("public/storage/favicon/" . $setting->favicon);
                }
            }
        } else {
            if (empty($setting->favicon)) {
                $oldPath = asset('public/admin/dist/img/no_image_available.png'); // public/admin/dist/img/no_image_available.png
                $fileExtension = File::extension($oldPath);
                $favicon = rand(10000, 99999) . "." . $fileExtension;
                $path = 'public/storage/favicon/';
                $newPathWithName =  $path . $favicon;
                if (!File::exists($path)) {
                    File::makeDirectory($path, 0777, true); //creates directory
                }
                File::copy($oldPath, $newPathWithName);
            } else {
                $favicon = $setting->favicon;
            }
        }
        //database create or update
        Setting::updateOrCreate(
            ['id' => '1'],
            [
                'title' => $request->title,
                'logo' => $logo,
                'favicon' => $favicon
            ]
        );
        //redirect
        return redirect()->route('web.index')->with('success', 'Web Setting Update Suceessfully !');
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
