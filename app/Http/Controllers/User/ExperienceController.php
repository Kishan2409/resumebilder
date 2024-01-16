<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {

            $Experience = Experience::query();

            return DataTables::eloquent($Experience)
                ->addColumn('action', function ($e) {
                    $editUrl = url('user/experience/edit', encrypt($e->id));

                    $deleteUrl = url('user/experience/delete', encrypt($e->id));

                    $viewUrl = url('user/experience/show', encrypt($e->id));

                    $actions = '';

                    $actions .= "<a href='" . $editUrl . "' class='btn btn-primary btn-sm m-1 text-decoration-none '><i class='fas fa-pencil-alt'></i> Edit</a>";
                    $actions .= "<a href='" . $viewUrl . "' class='btn btn-success btn-sm m-1 text-decoration-none '><i class='fas fa-eye'></i> View</a>";
                    $actions .= "<a href='" . $deleteUrl . "' class='btn btn-danger btn-sm m-1 text-decoration-none  delete' id='delete' data-id='" . $e->id . "'><i class='fa-regular fa-trash-can'></i> Delete</a>";

                    if ($e->status == 0) {
                        $actions .= " <a id='activate' href='#' class='activate btn btn-warning text-decoration-none btn-sm ' data-id='" . $e->id . "'><i class='fa-solid fa-check'></i> Active</a>";
                    } else {
                        $actions .= " <a id='deactivate' href='#'class='deactivate btn btn-warning btn-sm  text-decoration-none ' data-id='" . $e->id . "'><i class='fa-solid fa-ban'></i> Inactive</a>";
                    }

                    return $actions;
                })
                ->editColumn('status', function ($e) {
                    if ($e->status == 0) {
                        return "<center><span class='badge badge-danger'>Inactive</span></center>";
                    } else {
                        return "<center><span class='badge badge-success'>Active</span></center>";
                    }
                })
                ->filter(function ($data) use ($request) {
                    if ($request->get('status') == '0' || $request->get('status') == '1') {
                        $data->where('status', $request->get('status'));
                    }
                    if (!empty($request->get('search'))) {
                        $data->where(function ($wordsearch) use ($request) {
                            $search = $request->get('search');
                            $wordsearch->orWhere('company_name', 'LIKE', "%$search%")
                                ->orWhere('company_address', 'LIKE', "%$search%")
                                ->orWhere('role', 'LIKE', "%$search%")
                                ->orWhere('description', 'LIKE', "%$search%");
                        });
                    }
                })
                ->rawColumns(['action', 'status'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('layouts.experience.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('layouts.experience.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $data = [
            'added_by' => auth()->user()->id,
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'joining_date' => $request->joining_date,
            'leaving_date' => $request->leaving_date,
            'role' => $request->role,
            'description' => $request->company_description,
            'status' => $request->status,
        ];

        Experience::create($data);

        return redirect()->route('user.experience.index')->with('success', 'Experiences Section Add Suceessfully !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        $data = Experience::where('id', decrypt($id))->first();
        return view('layouts.experience.view',  compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = Experience::where('id', decrypt($id))->first();
        return view('layouts.experience._form',  compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        Experience::where('id', decrypt($id))->update(
            [
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'joining_date' => $request->joining_date,
                'leaving_date' => $request->leaving_date,
                'role' => $request->role,
                'description' => $request->company_description,
                'status' => $request->status,
            ]
        );

        return redirect()->route('user.experience.index')->with('success', 'Experiences Section Update Suceessfully !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        $id = $request->id;
        $data = Experience::where('id', $id)->first();
        $data->delete();
        return response()->json(['status' => true]);
    }


    public function status(Request $request)
    {
        $id = $request->id;
        $Experience = Experience::where('id', $id)->first();

        if ($Experience->status == 1) {

            Experience::where('id', $id)->update(['status' => 0]);

            return response()->json([
                'status' => true
            ]);
        } else {
            Experience::where('id', $id)->update(['status' => 1]);

            return response()->json([
                'status' => true
            ]);
        }
    }
}
