<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sector;

class SectorController extends Controller
{
    public function index()
    {
        $data = Sector::withCount(['projects' => function($q){
            $q->where('is_published',1);
        }])->with(['children'])->where('is_active', 1)->where('parent_id', Null)->get();

            return response()->json([
                'status' => 200,
                'message' => 'Parent sectors fetched',
                'data' => $data
            ], 200);
    }
}
