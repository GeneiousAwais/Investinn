<?php

namespace App\Http\Controllers;

use App\Models\ProjectStage;
use Illuminate\Http\Request;
use DataTables;

class ProjectStageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ProjectStage::get();
            // dd($data);
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                return ($row->is_active == 'inactive') ? '<span class="badge badge-outline-danger">  Inactive </span>' : '<span class="badge badge-outline-success">Active</span>';
            })
            ->addColumn('action', function ($row) {
                return view('settings.project_stages.actions',['row'=>$row]);
            })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        return view('settings.project_stages.project_stages');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:project_stages,title'
        ]);

        ProjectStage::create($request->all());

        return redirect()->route('project-stages.index')
            ->with('success', 'Project stage created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectStage  $projectStage
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectStage $projectStage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectStage  $projectStage
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectStage $projectStage)
    {
        return view('settings.project_stages.project_stages', ['projectStage' => $projectStage]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectStage  $projectStage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectStage $projectStage)
    {
        $request->validate([
            'title' => 'required|unique:project_stages,title,' . $projectStage->id,
        ]);

        $projectStage->update($request->all());

        return redirect()->route('project-stages.index')->with('success', 'Project stage updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectStage  $projectStage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectStage $projectStage)
    {
       try {
            return $projectStage->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
