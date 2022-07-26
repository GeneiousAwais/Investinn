<?php

namespace App\Http\Controllers;

use App\Models\ProjectSdg;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;

use App\Models\SustainableDevelopmentGoal;
use DataTables;

class ProjectSdgController extends Controller
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

            if(isset($request->project_id))
            {
                $data = ProjectSdg::where('commentable_id',$request->project_id)->with(['sdg'])->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('projects.project_sdg.actions',['row'=>$row]);
                })
                ->rawColumns(['action'])
                ->make(true);
                 return redirect(route('projects.edit', $request->project_id) . '?tab=sdgs')->with('success', 'Project SDG has been saved successfully.');
            }
            else
            {
                $data = ProjectSdg::where('commentable_id',$request->investor_id)->with(['sdg'])->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('investors.investor_sdgs.actions',['row'=>$row]);
                })
                ->rawColumns(['action'])
                ->make(true);
                 return redirect(route('shareholders.edit', $request->investor_id) . '?tab=sdg')->with('success', 'Investor SDG has been saved successfully.');
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
        // dd($request->all());
        $request->validate([
            'sdg_id' => 'required'
        ]);
        
        foreach ($request->sdg_id as $key => $value) {
            if($request->form_info == 'projects_sdgs')
            {

                $project = Project::find($request->project_id);
                $projectSdg = new ProjectSdg;
                $projectSdg->sdg_id = $value;  
                $project->sdgs()->save($projectSdg);

            }
            else
            {

                $investor = User::find($request->investor_id);
                $investorSdg = new ProjectSdg;
                $investorSdg->sdg_id = $value;  
                $investor->sdgs()->save($investorSdg);

            }
        }

        if($request->form_info == 'projects_sdgs')
            return redirect(route('projects.edit', $request->project_id) . '?tab=sdgs')->with('success', 'Project SDG has been saved successfully.');
        else
            return redirect(route('shareholders.edit', $request->investor_id) . '?tab=sdgs')->with('success', 'Investor SDG has been saved successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectSdg  $projectSdg
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectSdg $projectSdg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectSdg  $projectSdg
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectSdg $projectSdg)
    {
        return redirect(route('projects.edit',  $projectSdg->project_id) .'?tab=sdgs&sdg_id='.$projectSdg->id)->with('success', 'Project SDG has been saved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectSdg  $projectSdg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectSdg $projectSdg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectSdg  $projectSdg
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectSdg $projectSdg)
    {
        try {
            return $projectSdg->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
