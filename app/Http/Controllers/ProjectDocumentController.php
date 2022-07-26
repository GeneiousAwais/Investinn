<?php

namespace App\Http\Controllers;

use App\Models\ProjectDocument;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProjectDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $data = $request->all();

        $exist_record = ProjectDocument::where('project_id',$request->project_id)->first();

        if ($request->hasfile('business_case')) {
            $path = public_path() . '/files/project_details_files/';
            if (!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }
            $destination_path = public_path('/files/project_details_files/');
            $emp_img_filename = Str::random(32) . '.' . $request->business_case->getClientOriginalExtension();
            $request->business_case->move($destination_path, $emp_img_filename);
            $data['business_case'] = $emp_img_filename;
        }

        if ($request->hasfile('slide_deck')) {
            $path = public_path() . '/files/project_details_files/';
            if (!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }
            $destination_path = public_path('/files/project_details_files/');
            $emp_img_filename = Str::random(32) . '.' . $request->slide_deck->getClientOriginalExtension();
            $request->slide_deck->move($destination_path, $emp_img_filename);
            $data['slide_deck'] = $emp_img_filename;
        }

        if ($request->hasfile('financial_documents')) {
            $path = public_path() . '/files/financial_documents_files/';
            if (!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }
            $destination_path = public_path('/files/financial_documents_files/');
            $emp_img_filename = Str::random(32) . '.' . $request->financial_documents->getClientOriginalExtension();
            $request->financial_documents->move($destination_path, $emp_img_filename);
            $data['financial_documents'] = $emp_img_filename;
        }
        if($exist_record)
        {
            $exist_record->update($data);
        }

        else
        {
            ProjectDocument::create($data);
        } 

        return redirect(route('projects.edit', $request->project_id) . '?tab=documents')->with('success', 'Project documents has been saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectDocument  $projectDocument
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectDocument $projectDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectDocument  $projectDocument
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectDocument $projectDocument)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectDocument  $projectDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectDocument $projectDocument)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectDocument  $projectDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectDocument $projectDocument)
    {
        //
    }
}
