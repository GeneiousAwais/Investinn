<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class InvestorController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->get('per_page',0);
        $page_no = $request->get('page_no',1);
        $start = $per_page ? (($page_no - 1) * $per_page) : 0;

        $data = User::with([
            'investor' => function($query){
                $query->with([
                    'countries',
                    'sectors',
                    'investmentRanges',
                ]);
            }
        ])->where('user_type_id',1);

        if ($per_page)
            $data = $data->limit($per_page);

        if ($start)
            $data = $data->offset($start);

        $data = $data->get();

        return response()->json([
            'status' => 200,
            'message' => 'Investors record fetched',
            'data' => $data
        ], 200);
    }

    public function show($id){

        $data = User::with([
            'investor' => function($query){
                $query->with([
                    'countries',
                    'sectors',
                    'investmentRanges',
                ]);
            },
            'investor_sectors.sectors',
            'project_investors.projects.contactUs',
            'project_mentors.projects.contactUs',
        ])->withCount(['project_investors AS investment_amount_sum' => function ($query) {
                    $query->select(\DB::raw("SUM(invest_amount) as investment_amount_sum"));
                }
            ])
            ->where([['id',$id],['user_type_id',1]])->first();

        if($data && isset($data['investor']['investmentRanges'])){
            $data['investment_percentage'] = 0;
            $data['investment_amount_sum'] = $data['investment_amount_sum'] ? $data['investment_amount_sum'] : 0;
            $data['investment_percentage'] = round(( $data['investment_amount_sum'] / $data['investor']['investmentRanges']['range_value'] ) * 100,2);
            $data['investor']['investmentRanges']['range_value'] = convertNumberToWord($data['investor']['investmentRanges']['range_value']);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Investor record fetched',
            'data' => $data
        ], 200);
    }
}
