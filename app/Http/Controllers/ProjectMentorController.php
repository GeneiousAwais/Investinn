<?php

namespace App\Http\Controllers;
use App\Models\ProjectMentor;
use Illuminate\Http\Request;

use App\Models\Project;
use App\Models\User;
use DataTables;

class ProjectMentorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->all());

        if ($request->ajax()) {
            if(isset($request->mentor_id)){
                $data = ProjectMentor::where('project_mentor',$request->mentor_id)->with(['projects'])->get();
                // dd($data->toArray());
                return Datatables::of($data)
                ->addIndexColumn()
                // ->addColumn('action', function ($row) {
                //     return view('investors.project_mentors.actions',['row'=>$row]);
                // })
                // ->rawColumns(['action'])
                ->make(true);
                return redirect(route('shareholders.edit', $request->mentor_id) . '?tab=mentors')->with('success', 'Project mentors List.');
            }
            else{
                $data = ProjectMentor::where('project_id',$request->project_id)->with(['projects','user'])->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('projects.project_mentors.actions',['row'=>$row]);
                })
                ->rawColumns(['action'])
                ->make(true);
                 return redirect(route('projects.edit', $request->project_id) . '?tab=mentors')->with('success', 'Project mentors has been saved successfully.');
            }
            
        }

        
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
            'project_mentor' => 'required'
        ]);
        foreach ($request->project_mentor as $key => $value) {
            $project_mentor['project_id'] = $request->project_id;
            $project_mentor['project_mentor'] = $value;
            ProjectMentor::create($project_mentor);
        }
        return redirect(route('projects.edit', $request->project_id) . '?tab=mentors')->with('success', 'Project mentor has been saved successfully.');


        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectMentor  $projectMentor
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectMentor $projectMentor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectMentor  $projectMentor
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectMentor $projectMentor)
    {
        return redirect(route('projects.edit',  $projectMentor->project_id) .'?tab=mentors&mentor_id='.$projectMentor->id)->with('success', 'Project mentor has been saved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectMentor  $projectMentor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectMentor $projectMentor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectMentor  $projectMentor
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectMentor $projectMentor)
    {
        try {
            return $projectMentor->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
