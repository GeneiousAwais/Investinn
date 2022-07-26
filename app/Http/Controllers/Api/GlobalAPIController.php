<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Investor;
use App\Models\Project;
use App\Models\ProjectFinancial;
use App\Models\ProjectInvestor;
use App\Models\User;
use Illuminate\Http\Request;

class GlobalAPIController extends Controller
{
    public function get_stats(Request $request)
    {
        $project_financial = ProjectFinancial::whereHas('projects' , function ($q){
            $q->where('is_published',1);
        });

        $data['total_projects'] = number_format(Project::where('is_published',1)->count());
        $data['total_funds_needed'] = number_format($project_financial->sum('current_target_to_raise'));
        $data['total_funds_raised'] = number_format($project_financial->sum('raised_so_far'));
        $data['total_investors'] = number_format(User::where('user_type_id',1)->count());
        $data['total_funds_pledged'] = number_format(array_sum(Investor::withCount(['investmentRanges AS funds_pledge_sum' =>
            function ($query) {
                $query->select(\DB::raw("SUM(range_value) as funds_pledge_sum"));
            }])->whereHas('users')->pluck('funds_pledge_sum')->toArray()));

        return response()->json(['status' => 200, 'message' => 'Stats Data Sent Successfully.', 'data' => $data], 200);
    }
}
