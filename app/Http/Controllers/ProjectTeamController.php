<?php

namespace App\Http\Controllers;

use App\Models\ProjectTeam;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
class ProjectTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = ProjectTeam::where('project_id',$request->project_id)->with(['projects'])->get();
            // dd($data->toArray());
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('projects.project_teams.actions',['row'=>$row]);
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return redirect(route('projects.edit', $request->project_id) . '?tab=teams')->with('success', 'Project financials has been saved successfully.');
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
            $exist_record = ProjectTeam::find($request->id);
        }

        // if ($request->hasfile('picture')) {
        //     $path = public_path() . '/files/project_teams/';
        //     if (!File::exists($path)) {
        //         File::makeDirectory($path, $mode = 0777, true, true);
        //     }
        //     $destination_path = public_path('/files/project_teams/');
        //     $emp_img_filename = Str::random(32) . '.' . $request->picture->getClientOriginalExtension();
        //     $request->picture->move($destination_path, $emp_img_filename);
        //     $input['picture'] = $emp_img_filename;
        // }

        if ($request->base64data && $request->base64data != '') {
            $path = public_path() . '/files/project_teams/';
            if (!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            $image_parts = explode(";base64,", $request->base64data);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $imageName = uniqid() . '.png';
            $imageFullPath = $path.$imageName;
            file_put_contents($imageFullPath, $image_base64);
            $input['picture'] = $imageName;
        }



        
        if($exist_record){
            $exist_record->update($input);
        }
        else{
            $input['project_id'] = $request->project_id;
            ProjectTeam::create($input);
        }
        return redirect(route('projects.edit', $request->project_id) . '?tab=teams')->with('success', 'Project Team has been saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectTeam  $projectTeam
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectTeam $projectTeam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectTeam  $projectTeam
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectTeam $projectTeam)
    {
        return redirect(route('projects.edit',  $projectTeam->project_id) .'?tab=teams&team_id='.$projectTeam->id)->with('success', 'Project financials has been saved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectTeam  $projectTeam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectTeam $projectTeam)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectTeam  $projectTeam
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectTeam $projectTeam)
    {
        try {
            return $projectTeam->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
