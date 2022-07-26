<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class OpportunityController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->get('per_page',0);
        $page_no = $request->get('page_no',1);
        $start = $per_page ? (($page_no - 1) * $per_page) : 0;

        $data = Project::with([
            'sectors.children',
            'sub_sector',
            'financials',
            'featured_image',
        ])->where('is_published',1);

        if ($request->sector_id)
            $data = $data->where('sector_id',$request->sector_id);
        if (isset($request->sub_sector_id))
            $data = $data->where('sub_sector_id',$request->sub_sector_id);
        if (isset($request->is_featured))
            $data = $data->where('is_featured',1);

        if (isset($request->search)){
            $data->where(function ($query) use ($request){
                $query->where('project_title', 'like','%'. $request->search.'%');
                $query->orWhere('highlights','like','%'. $request->search.'%');
                $query->orWhere('executive_summary','like','%'. $request->search.'%');
            });
        }

        $count = $data->count();

        if ($per_page)
            $data = $data->limit($per_page);

        if ($start)
            $data = $data->offset($start);

        $data = $data->get();

        return response()->json([
            'status' => 200,
            'message' => 'Projects record fetched',
            'count' => $count,
            'data' => $data
        ], 200);
    }
    public function all()
    {
        $data = Project::with(['sectors.children'])->all();
        return response()->json([
            'status' => 200,
            'message' => 'All projects record fetched',
            'data' => $data
        ], 200);
    }


    public function opportunityDetail($id)
    {
        $data = Project::with([
            'sectors',
            'sub_sector',
            'stages',
            //'partnershipType',
            'financials.dealTypes',
            'teams',
            'contactUs',
            'project_medias',
            'potential_location',
            'project_investors.user.investor',
            'project_mentors.user.investor',
            'sdgs.active_sdg'
        ])->where('id',$id)->first();

        return response()->json([
            'status' => 200,
            'message' => 'Projects record fetched',
            'data' => $data
        ], 200);
    }
}
