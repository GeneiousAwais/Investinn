<?php

namespace App\Http\Controllers;

use App\Models\ProjectFinancial;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjectFinancialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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

        $exist_record = ProjectFinancial::where('project_id',$request->project_id)->first();

        if($exist_record)
        {
            $exist_record->update($input);
        }

        else
        {
            ProjectFinancial::create($input);
        }
        return redirect(route('projects.edit', $request->project_id) . '?tab=teams')->with('success', 'Project financials has been saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectFinancial  $projectFinancial
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectFinancial $projectFinancial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectFinancial  $projectFinancial
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectFinancial $projectFinancial)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectFinancial  $projectFinancial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectFinancial $projectFinancial)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectFinancial  $projectFinancial
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectFinancial $projectFinancial)
    {
        //
    }
}
