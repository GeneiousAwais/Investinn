<?php

namespace App\Http\Controllers;

use App\Models\ProjectContactUs;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


use DataTables;
class ProjectContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
        
        $exist_record = ProjectContactUs::where('project_id',$request->project_id)->first();

        if ($request->base64data) {
            $path = public_path() . '/files/contact_us_files/';
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
            $data['logo'] = $imageName;
        }


        
        if($exist_record){
            $exist_record->update($data);
        }
        else{
            $data['project_id'] = $request->project_id;
            ProjectContactUs::create($data);
        }

        return redirect(route('projects.edit', $request->project_id) . '?tab=photos')->with('success', 'Project contact us info has been saved successfully.');

        // return redirect(route('projects.index') )->with('success', 'Project teams has been saved successfully.');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectContactUs  $projectContactUs
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectContactUs $projectContactUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectContactUs  $projectContactUs
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectContactUs $projectContactUs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectContactUs  $projectContactUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectContactUs $projectContactUs)
    {
        //
    }

    public function uploadCropImage(Request $request)
    {
        $data = $request->all();
        $folderPath = public_path() . '/files/contact_us_files/';
 
        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $imageName = uniqid() . '.png';
        $imageFullPath = $folderPath.$imageName;
        file_put_contents($imageFullPath, $image_base64);
         $exist_record = User::where('id',$request->id)->first();
         $data['profile_picture'] = $imageName;

         if($exist_record){
            $exist_record->update($data);
        }
        else{
            User::create($data);
        }
        return response()->json(['success'=>'Crop Image Uploaded Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectContactUs  $projectContactUs
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectContactUs $projectContactUs)
    {
        //
    }
}
