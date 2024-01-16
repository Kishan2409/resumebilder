<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Education;
use App\Models\Skills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class AboutController extends Controller
{
    //view
    public function index()
    {
        //

        $id = auth()->user()->id;
        $data = About::where('added_by', $id)->first();

        return view('layouts.about.index', compact('data'));
    }

    //about store and update
    public function store(Request $request)
    {
        //
        $id = auth()->user()->id;
        $about = About::where('added_by', $id)->first();

        if ($request->hasFile('image')) {
            $imageName = $request->file('image');
            $image = rand(10000, 99999) . '.' . $imageName->getClientOriginalExtension();
            $imageName->move('public/storage/about/', $image);
            if (!empty($about->image)) {
                if (File::exists("public/storage/about/" . $about->image)) {
                    File::delete("public/storage/about/" . $about->image);
                }
            }
        } else {
            $image = $about->image;
        }

        if (!empty($about)) {
            About::where('added_by', $id)->update([
                "description" => $request->description,
                "image" => $image
            ]);
        } else {
            About::Create(
                [
                    "added_by" => $id,
                    "description" => $request->description,
                    "image" => $image
                ]
            );
        }

        //redirect
        return redirect()->route('user.about.index')->with('success', 'About Section Update Suceessfully !');
    }

    //skills datatable
    public function getskillsdata()
    {
        $skills = Skills::query();
        return DataTables::eloquent($skills)
            ->addColumn('action', function ($s) {


                $deleteUrl = url('user/about/skill/delete', encrypt($s->id));

                $actions = '';

                $actions .= "<button type='button'  data-id='" . $s->id . "' data-toggle='modal' data-target='#staticBackdropedit' class='btn btn-primary btn-sm m-1 text-decoration-none edit-btn'><i class='fas fa-pencil-alt'></i> Edit</button>";
                // $actions .= "<a href='" . $viewUrl . "' class='btn btn-success btn-sm m-1 text-decoration-none '><i class='fas fa-eye'></i> View</a>";
                $actions .= "<a href='" . $deleteUrl . "' class='btn btn-danger btn-sm m-1 text-decoration-none  delete' id='delete' data-id='" . $s->id . "'><i class='fa-regular fa-trash-can'></i> Delete</a>";

                return $actions;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    //skill store
    public function skillstore(Request $request)
    {
        //
        $id = auth()->user()->id;
        $about = About::where('added_by', $id)->first();
        if (!empty($about)) {
            $data = [
                "about_id" => $about->id,
                "skills_name" => $request->skills_name,
                "skills_percentage" => $request->skills_percentage
            ];
            Skills::create($data);
            return redirect()->route('user.about.index')->with('success', 'Skills Section Add Suceessfully !');
        }
        return redirect()->route('user.about.index')->with('error', 'First Add About Section !');
    }

    //skills edit
    public function edit(Request $request)
    {
        //
        $id = $request->id;

        $skill = Skills::find($id);

        return response()->json(['data' => $skill]);
    }

    //skills update
    public function update(Request $request)
    {
        //
        $id = $request->edit_skills_id;

        $skill = Skills::where('id', $id)->first();

        Skills::where('id', $skill->id)->update([
            'skills_name' => $request->edit_skills_name,
            'skills_percentage' => $request->edit_skills_percentage
        ]);

        return redirect()->route('user.about.index')->with('success', 'Skills Section Update Suceessfully !');
    }

    //skills destroy
    public function destroy(Request $request)
    {
        //
        $id = $request->id;

        Skills::where('id', $id)->delete();
        return response()->json(['status' => true]);
    }

    //education datatable
    public function geteducationdata()
    {
        $education = Education::query();
        return DataTables::eloquent($education)
            ->addColumn('action', function ($e) {


                $deleteUrl = url('user/about/education/delete', encrypt($e->id));

                $actions = '';

                $actions .= "<button type='button'  data-id='" . $e->id . "' data-toggle='modal' data-target='#staticBackdrop_editEducation' class='btn btn-primary btn-sm m-1 text-decoration-none edit-btn'><i class='fas fa-pencil-alt'></i> Edit</button>";
                // $actions .= "<a href='" . $viewUrl . "' class='btn btn-success btn-sm m-1 text-decoration-none '><i class='fas fa-eye'></i> View</a>";
                $actions .= "<a href='" . $deleteUrl . "' class='btn btn-danger btn-sm m-1 text-decoration-none  delete' id='delete' data-id='" . $e->id . "'><i class='fa-regular fa-trash-can'></i> Delete</a>";

                return $actions;
            })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

    //education store
    public function educationstore(Request $request)
    {
        //
        $id = auth()->user()->id;
        $about = About::where('added_by', $id)->first();

        if (!empty($about)) {

            if ($request->hasFile('result_image')) {
                $imageName = $request->file('result_image');
                $image = rand(10000, 99999) . '.' . $imageName->getClientOriginalExtension();
                $imageName->move('public/storage/education/', $image);
            } else {
                $image = "";
            }

            $data = [
                "about_id" => $about->id,
                "education_degree_name" => $request->degree_name,
                "education_pass_out_year" => $request->pass_out_year,
                "education_result_image" => $image,
            ];

            Education::create($data);
            return redirect()->route('user.about.index')->with('success', 'Education Section Add Suceessfully !');
        }
        return redirect()->route('user.about.index')->with('error', 'First Add About Section !');
    }

    //education edit
    public function educationedit(Request $request)
    {
        //
        $id = $request->id;
        $education = Education::find($id);
        return response()->json(['data' => $education]);
    }

    //education update
    public function educationupdate(Request $request)
    {
        //
        $id = $request->edit_education_id;

        $education = Education::where('id', $id)->first();

        if ($request->hasFile('edit_result_image')) {
            $imageName = $request->file('edit_result_image');
            $image = rand(10000, 99999) . '.' . $imageName->getClientOriginalExtension();
            $imageName->move('public/storage/education/', $image);
            if (!empty($education->education_result_image)) {
                if (File::exists("public/storage/education/" . $education->education_result_image)) {
                    File::delete("public/storage/education/" . $education->education_result_image);
                }
            }
        } else {
            $image = $education->education_result_image;
        }

        Education::where('id', $education->id)->update([
            'education_degree_name' => $request->edit_degree_name,
            'education_pass_out_year' => $request->edit_pass_out_year,
            'education_result_image' => $image,
        ]);

        return redirect()->route('user.about.index')->with('success', 'Education Section Update Suceessfully !');
    }

    //education destroy
    public function educationdestroy(Request $request)
    {
        //
        $id = $request->id;

        Education::where('id', $id)->delete();
        return response()->json(['status' => true]);
    }
}
