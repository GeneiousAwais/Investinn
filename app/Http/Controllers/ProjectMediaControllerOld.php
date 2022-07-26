<?php

namespace App\Http\Controllers;

use App\Models\ProjectMedia;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ProjectMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = ProjectMedia::where('project_id',$request->project_id)->with(['projects'])->get();
            // dd($data->toArray());
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('projects.project_media.actions',['row'=>$row]);
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return redirect(route('projects.edit', $request->project_id) . '?tab=photos')->with('success', 'Project contact us info has been saved successfully.');
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
        $image = $request->file('file');
        $project_id = $request->project_id;
        $fileInfo = $image->getClientOriginalName();
        $filename = pathinfo($fileInfo, PATHINFO_FILENAME);
        $extension = pathinfo($fileInfo, PATHINFO_EXTENSION);
        $file_name= $filename.'-'.time().'.'.$extension;
        $image->move(public_path('files/project_media'),$file_name);
        
        $imageUpload = new ProjectMedia;
        $imageUpload->picture = $file_name;
        $imageUpload->project_id = $project_id;
        $imageUpload->save();
        return response()->json(['success'=>$file_name]);
    }


    // public function store(Request $request)
    // {
    //     $data = array();
    //     $input = $request->all();

    //     if($request->file('file')) {

    //         $file = $request->file('file');
    //         $filename = time().'_'.$file->getClientOriginalName();
    //         $location = 'files/project_media';
    //         $file->move($location,$filename);
    //         $data['success'] = 1;
    //         $data['message'] = 'Uploaded Successfully!';
    //         $input['picture'] = $filename;
    //     }
    //     else
    //     {
    //         $data['success'] = 0;
    //         $data['message'] = 'File not uploaded.'; 
    //     }
    //     ProjectMedia::create($input);


    //     // return redirect(route('projects.edit', $request->project_id) . '?tab=photos')->with('success', 'Project Media has been saved successfully.');


    //        return response()->json($data);
     

    //     // $serverId = $request->server_id;
    //     // $projectId = $request->project_id;

    //     // $filepond = app(\Sopamo\LaravelFilepond\Filepond::class);
    //     // $disk = config('filepond.temporary_files_disk');

    //     // $filePath = $filepond->getPathFromServerId($serverId);
    //     // echo $fullpath = Storage::disk($disk)->get($filePath);


    //     // // Move the file from the temporary path to the final location
    //     // // $finalLocation = public_path('output.jpg');

    //     // $finalLocation = public_path('/files/project_media/');

    //     // if (!File::exists($finalLocation)) {
    //     //     File::makeDirectory($finalLocation, $mode = 0777, true, true);
    //     // }

    //     // echo $finalLocation = $finalLocation . uniqid() . '.png';

    //     // exit;

    //     // \File::move($fullpath, $finalLocation);


    //     /*
    //     $input = $request->all();
    //     $exist_record ='';
    //     if($request->id){
    //         $exist_record = ProjectMedia::find($request->id);
    //     }

    //     if ($request->base64data) {
            
    //         $path = public_path() . '/files/project_media/';
    //         if (!File::exists($path)) {
    //             File::makeDirectory($path, $mode = 0777, true, true);
    //         }

    //         $image_parts = explode(";base64,", $request->base64data);
    //         $image_type_aux = explode("image/", $image_parts[0]);
    //         $image_type = $image_type_aux[1];
    //         $image_base64 = base64_decode($image_parts[1]);
    //         $imageName = uniqid() . '.png';
    //         $imageFullPath = $path.$imageName;
    //         file_put_contents($imageFullPath, $image_base64);
    //         $input['picture'] = $imageName;
    //     }
        
    //     if($exist_record){
    //         $exist_record->update($input);
    //     }
    //     else{
    //         $input['project_id'] = $request->project_id;
    //         ProjectMedia::create($input);
    //     }
    //     return redirect(route('projects.edit', $request->project_id) . '?tab=photos')->with('success', 'Project Media has been saved successfully.');


    //     */

    // }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProjectMedia  $projectMedia
     * @return \Illuminate\Http\Response
     */
    public function show(ProjectMedia $projectMedia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectMedia  $projectMedia
     * @return \Illuminate\Http\Response
     */

    public function edit(ProjectMedia $ProjectMedia)
    {
        return redirect(route('projects.edit',  $ProjectMedia->project_id) .'?tab=photos&media_id='.$ProjectMedia->id)->with('success', 'Project media has been update successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectMedia  $projectMedia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectMedia $projectMedia)
    {
        //
    }

    public function getImages(Request $request)
    {
        // dd($request->all());
        $images = ProjectMedia::where('project_id',$request->project_id)->get()->toArray();
        $data = array();
        $tableImages =null;
        foreach($images as $image){
            $tableImages[] = $image['picture'];
        }
        

        $storeFolder = public_path('files/project_media');
        $file_path = public_path('files/project_media/');
        $files = scandir($storeFolder);

        foreach ($files as $file ) {
            if ($file !='.' && $file !='..' && in_array($file,$tableImages)) {
                $obj['name'] = $file;
                $file_path = public_path('files/project_media/').$file;
                $obj['size'] = filesize($file_path);          
                $obj['path'] = url('files/project_media/'.$file);
                $data[] = $obj;
            }

        }
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectMedia  $projectMedia
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectMedia $projectMedia, $id)
    {
        $projectMedia = ProjectMedia::findOrFail($id);
        //dd($projectMedia);
        try {
            return $projectMedia->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }

    public function trashImage(Request $request)
    {
        $filename =  $request->get('filename');
        ProjectMedia::where('picture',$filename)->delete();
        $path = public_path('uploads/gallery/').$filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return response()->json(['success'=>$filename]);
    }  
}
