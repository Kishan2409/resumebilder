<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {

            $Service = Service::query();

            return DataTables::eloquent($Service)
                ->addColumn('action', function ($s) {
                    $editUrl = url('user/service/edit', encrypt($s->id));

                    $deleteUrl = url('user/service/delete', encrypt($s->id));

                    $viewUrl = url('user/service/show', encrypt($s->id));

                    $actions = '';

                    $actions .= "<a href='" . $editUrl . "' class='btn btn-primary btn-sm m-1 text-decoration-none '><i class='fas fa-pencil-alt'></i> Edit</a>";
                    $actions .= "<a href='" . $viewUrl . "' class='btn btn-success btn-sm m-1 text-decoration-none '><i class='fas fa-eye'></i> View</a>";
                    $actions .= "<a href='" . $deleteUrl . "' class='btn btn-danger btn-sm m-1 text-decoration-none  delete' id='delete' data-id='" . $s->id . "'><i class='fa-regular fa-trash-can'></i> Delete</a>";

                    if ($e->status == 0) {
                        $actions .= " <a id='activate' href='#' class='activate btn btn-warning text-decoration-none btn-sm ' data-id='" . $s->id . "'><i class='fa-solid fa-check'></i> Active</a>";
                    } else {
                        $actions .= " <a id='deactivate' href='#'class='deactivate btn btn-warning btn-sm  text-decoration-none ' data-id='" . $s->id . "'><i class='fa-solid fa-ban'></i> Inactive</a>";
                    }

                    return $actions;
                })
                ->editColumn('status', function ($s) {
                    if ($s->status == 0) {
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
        return view('layouts.service.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('layouts.service.form');
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
