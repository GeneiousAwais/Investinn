<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

// use DataTables;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Blog::with('user')->get();
            // dd($data->toArray());
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                return ($row->is_active == 'inactive') ? '<span class="badge badge-outline-danger">  Inactive </span>' : '<span class="badge badge-outline-success">Active</span>';
            })
            ->addColumn('action', function ($row) {
                return view('blogs.actions',['row'=>$row]);
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
        }
        return view('blogs.blogs');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staffs = User::where('user_type_id',4)->get();
        $data = ['staffs' => $staffs];
         return view('blogs.add_blog',$data);

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
            'title' => 'required|unique:blogs,title'
        ]);

        $data = $request->all();

        if ($request->base64data) {
            $path = public_path() . '/files/blogs/';
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
            $data['featured_image'] = $imageName;
        }
        Blog::create($data);

        return redirect()->route('blogs.index')
            ->with('success', 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $staffs = User::where('user_type_id',4)->get();
        $blogs = Blog::where('id',$id)->with('user')->first();
        
        $data = [
            'blog' => $blogs,
            'staffs' => $staffs
        ];

        return view('blogs.edit_blog', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|unique:blogs,title,' . $blog->id,
        ]);

        $data = $request->all();

        if ($request->base64data) {
            $path = public_path() . '/files/blogs/';
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
            $data['featured_image'] = $imageName;
        }


        $blog->update($data);

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function uploadCropImage(Request $request)
    {
        $data = $request->all();
        $blog = $request->id;
        $title = isset($request->title) ? $request->title: 'empty';
        $is_active = isset($request->is_active) ? $request->is_active: 0;
        $data['title'] = $title;
        $data['is_active'] = $is_active;
        $folderPath = public_path() . '/files/blogs/';
        $exist_record = null;
 
        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $imageName = uniqid() . '.png';
        $imageFullPath = $folderPath.$imageName;
        file_put_contents($imageFullPath, $image_base64);
        if($request->id){
            $exist_record = Blog::where('id',$request->id)->first();
        }
        $data['featured_image'] = $imageName;

         if($exist_record){
            $exist_record->update($data);
        }
        else{
            $blog = Blog::create($data);
        }

        return redirect(route('blogs.edit', $blog->id))->with('success', 'Oppurtunity Summary successfully saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        try
        {
            return $blog->delete();
        }
        catch (QueryException $e)
        {
            print_r($e->errorInfo);
        }
    }
}
