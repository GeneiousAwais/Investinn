<?php

namespace App\Http\Controllers;

use App\Models\ProjectInvestor;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;

class ProjectInvestorController extends Controller
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

            if($request->investor_id)
            {
                 $data = ProjectInvestor::where('project_investor',$request->investor_id)->with(['projects','user'])->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('invest_amount', function ($row) {
                    return is_null($row->invest_amount) ? '<span class="badge badge-outline-danger">N/A</span>' : number_format($row->invest_amount);
                })
                ->rawColumns(['invest_amount'])
                ->make(true);

                return redirect(route('shareholders.edit', $request->investor_id) . '?tab=investments')->with('success', 'Investor investment list.');

            }
            else
            {
                $data = ProjectInvestor::where('project_id',$request->project_id)->with(['projects','user'])->get();
                return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('invest_amount', function ($row) {
                    return is_null($row->invest_amount) ? '<span class="badge badge-outline-danger">N/A</span>' : number_format($row->invest_amount);
                })
                ->addColumn('action', function ($row) {
                    return view('projects.project_investors.actions',['row'=>$row]);
                })
                ->rawColumns(['action','invest_amount'])
                ->make(true);

                return redirect(route('projects.edit', $request->project_id) . '?tab=investments')->with('success', 'Project Investor has been saved successfully.');

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
        $input = $request->all();

        $exist_record ='';
        if($request->id){
            $exist_record = ProjectInvestor::find($request->id);
        }



        
        if($exist_record){
            $exist_record->update($input);
        }
        else{
            $input['project_id'] = $request->project_id;
            ProjectInvestor::create($input);
        }
        return redirect(route('projects.edit', $request->project_id) . '?tab=investments')->with('success', 'Project Investor has been saved successfully.');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectInvestor  $projectInvestor
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectInvestor $projectInvestor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectInvestor  $projectInvestor
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectInvestor $projectInvestor)
    {
        return redirect(route('projects.edit',  $projectInvestor->project_id) .'?tab=investments&investment_id='.$projectInvestor->id)->with('success', 'Project Investor has been saved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectInvestor  $projectInvestor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectInvestor $projectInvestor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectInvestor  $projectInvestor
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectInvestor $projectInvestor)
    {
        try {
            return $projectInvestor->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
