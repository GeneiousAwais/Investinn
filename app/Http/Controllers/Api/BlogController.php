<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->get('per_page',0);
        $page_no = $request->get('page_no',1);
        $start = $per_page ? (($page_no - 1) * $per_page) : 0;

        $data = Blog::with('user')->where('is_active',1);

        if ($per_page)
            $data = $data->limit($per_page);

        if ($start)
            $data = $data->offset($start);

        $data = $data->orderByDesc('id')->get();

        $data->map(function ($query){
            $query['tags'] = explode(',',$query->meta_tags);

            return $query;
        });

        return response()->json([
            'status' => 200,
            'message' => 'Blogs Data Sent Successfully.',
            'data' => $data
        ], 200);
    }

    public function show($id){

        $data = Blog::with([
            'user',
        ])->where('id',$id)->first();

        if ($data)
            $data['tags'] = $data['meta_tags'] ? explode(',',$data['meta_tags']) : array();

        return response()->json([
            'status' => 200,
            'message' => 'Blog record fetched',
            'data' => $data
        ], 200);
    }

    public function get_tags(Request $request){

        $per_page = $request->get('per_page',0);
        $page_no = $request->get('page_no',1);
        $start = $per_page ? (($page_no - 1) * $per_page) : 0;

        $data = Blog::select('meta_tags')->pluck('meta_tags')->toArray();

        $tags = array();
        foreach ($data as $value)
           $tags = $value ? (!empty($tags) ? array_merge($tags,explode(',',$value)) : explode(',',$value)) : $tags;

        $tags = array_slice(array_unique($tags),0,$per_page);

        return response()->json([
            'status' => 200,
            'message' => 'Tags Data Sent Successfully.',
            'data' => $tags
        ], 200);
    }
}
