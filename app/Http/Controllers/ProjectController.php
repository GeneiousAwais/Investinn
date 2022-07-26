<?php

namespace App\Http\Controllers;


use App\Models\Sector;
use App\Models\Project;
use App\Models\ProjectStage;
use App\Models\ProjectFinancial;
use App\Models\ProjectContactUs;
use App\Models\ProjectTeam;
use App\Models\ProjectMedia;
use App\Models\PotentialLocation;
use App\Models\PartnershipType;
use App\Models\User;
use App\Models\DealType;
use App\Models\City;
use App\Models\ProjectInvestor;
use App\Models\ProjectMentor;
use App\Models\ProjectSdg;
use App\Models\ProjectDocument;
use App\Models\SustainableDevelopmentGoal;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Sopamo\LaravelFilepond\Filepond;
use DataTables;

class ProjectController extends Controller
{

    public function index(Request $request)
    {

        $user_type_id = \Auth::user()->user_type_id;
        $staff_id = \Auth::user()->id;
        $data = '';

        if ($request->ajax()) {

            if($user_type_id == 2)
            {
                $data = Project::where('project_entrepreneur',$staff_id)->with(['sectors','stages','projectEntrepreneur']);
            }
            else{
                $data = Project::with(['sectors','stages','projectEntrepreneur']);
            }


            if ($request->sector_id && $request->sector_id > 0) {
                $data->where('sector_id', $request->sector_id);
            }

            if ($request->project_stage_id && $request->project_stage_id > 0) {
                $data->where('project_stage_id', $request->project_stage_id);
            }

            if ($request->project_entrepreneur  && $request->project_entrepreneur  > 0) {
                $data->where('project_entrepreneur', $request->project_entrepreneur);
            }


            if ($request->searchTerm && $request->searchTerm != null) {

                $data->orWhere('project_title', 'like', '%' . $request->searchTerm . '%');
            }

            $data = $data->orderBy('id', 'DESC')->get();


            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('projects.actions',['row'=>$row]);
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        $sectors = Sector::where('parent_id',null)->get();
        $projectStages = ProjectStage::get();
        $entrepreneurs = User::where('user_type_id',2)->get();

        return view('projects.projects', [
            'sectors' => $sectors,
            'projectStages' => $projectStages,
            'entrepreneurs' => $entrepreneurs
        ]);
    }

    public function create()
    {

        $sectors = Sector::where('parent_id',null)->get();
        $sub_sectors = Sector::where('parent_id','!=',null)->get();
        $projects = Project::get();
        $investor = User::where('user_type_id',1)->get();
        $entrepreneur = User::where('user_type_id',2)->get();
        $consultant = User::where('user_type_id',3)->get();
        $staffs = User::where('user_type_id',4)->get();
        $users = User::get();
        $sdgs= SustainableDevelopmentGoal::get();

        $projectStages = ProjectStage::get();
        $partnershipTypes = PartnershipType::get();
        //$projectMedia = ProjectMedia::get();
        $dealType = DealType::get();
        $cities = City::get();
        $data = [
            'summary' => 'active',
            'sectors' => $sectors,
            'projectStages' => $projectStages,
            'partnershipTypes' => $partnershipTypes,
            'investors'=> $investor,
            'entrepreneurs'=> $entrepreneur,
            'consultants'=> $consultant,
            'projects' => $projects,
            'dealTypes' => $dealType,
            'users' => $users,
            'cities' => $cities,
            'sub_sectors' => $sub_sectors,
            'staffs' => $staffs,
            'sdgs' => $sdgs
            //'projectMedia' => $projectMedia
        ];
        // dd($investor->toArray());
        return view('projects.add_form',$data);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'project_status' => 'required',
            'sector_id' => 'required',
            'sub_sector_id' => 'required',
            'project_entrepreneur' => 'required'
        ]);
        $data['project_tags']= isset($data['project_tags']) ? (implode(', ', array_column(json_decode($data['project_tags']), 'value'))) : '';

        $project = Project::create($data);

        return redirect(route('projects.edit', $project->id) . '?tab=details')->with('success', 'Oppurtunity Summary successfully saved.');
    }

    public function show(Project $project){}

    public function edit(Project $project, Request $request)
    {

        $sectors = Sector::where('parent_id',null)->get();
        $sub_sectors = Sector::where('parent_id','!=',null)->get();
        $projects = Project::where('id',$project->id)->get();
        $entrepreneur = User::where('user_type_id',2)->get();
        $consultant = User::where('user_type_id',3)->get();
        $staffs = User::where('user_type_id',4)->get();
        $users = User::get();
        $projectStages = ProjectStage::get();
        $partnershipTypes = PartnershipType::get();
        $dealType = DealType::get();
        $cities = City::get();
        $projectFinancials = ProjectFinancial::where('project_id',$project->id)->with('partnershipType')->first();
        $projectContactUs = ProjectContactUs::where('project_id',$project->id)->first();
        $projectTeam = '';
        $projectMedia = '';
        $projectInvestment = '';
        $projectMentor = '';
        $totalTeamMembers = ProjectTeam::where('project_id',$project->id)->count();
        $projectMediaCount = ProjectMedia::where('project_id',$project->id)->count();

        $projectPotentialLocations = PotentialLocation::where('project_id', $project->id)->get();


        $projectMentors = ProjectMentor::where('project_id',$project->id)->pluck('project_mentor');
        $investor = User::where('user_type_id',1)->whereNotIn('id', $projectMentors)->get();

        
        $projectSdgs = ProjectSdg::where('commentable_id',$project->id)->pluck('sdg_id');
        $sdgs= SustainableDevelopmentGoal::whereNotIn('id', $projectSdgs)->get();
        


        if(isset($request->team_id)){
            $projectTeam = ProjectTeam::where('id',$request->team_id)->first();
        }

        if(isset($request->media_id)){
            $projectMedia = ProjectMedia::where('id',$request->media_id)->first();
        }

        if(isset($request->mentor_id)){
            $projectMentor = ProjectMentor::where('id',$request->mentor_id)->first();
        }

        $projectDocuments = ProjectDocument::where('project_id', $project->id)->first();



        $data = [
            'project' => $project,
            'sectors' => $sectors,
            'projectStages' => $projectStages,
            'partnershipTypes' => $partnershipTypes,
            'investors'=> $investor,
            'entrepreneurs'=> $entrepreneur,
            'consultants'=> $consultant,
            'staffs' => $staffs,
            'projects' => $projects,
            'dealTypes' => $dealType,
            'users' => $users,
            'cities' => $cities,
            'sub_sectors' => $sub_sectors,
            'projectFinancials' => $projectFinancials,
            'projectContactUs' => $projectContactUs,
            'projectTeam' => $projectTeam,
            'totalTeamMembers' => $totalTeamMembers,
            'projectMedia' => $projectMedia,
            'projectMediaCount' => $projectMediaCount,
            'projectPotentialLocations' => $projectPotentialLocations,
            'projectInvestment' => $projectInvestment,
            'projectMentor' => $projectMentor,
            'projectMentors' => $projectMentors,
            'projectDocuments' =>$projectDocuments,
            'sdgs' => $sdgs
        ];
    
        return view('projects.add_form', $data);
    }

    public function update(Request $request, Project $project)
    {

        $staff_id = \Auth::user()->id;
        $data = $request->all();

        

        $data['project_tags']= isset($data['project_tags']) ? (implode(', ', array_column(json_decode($data['project_tags']), 'value'))) : '';

        $project->update($data);

        if ($request->form_info == 'summary') {

            return redirect(route('projects.edit', $project->id) . '?tab=details')->with('success', 'Project summary has been saved successfully.');
        }

        if ($request->form_info == 'details') {
            return redirect(route('projects.edit', $project->id) . '?tab=financials')->with('success', 'Project Details has been saved successfully.');
        }

    }

    public function listSubSectors(Request $request)
    {
        $data = Sector::where('parent_id', $request->id)->get();
        return response()->json($data);
    }

    public function getInvestorDashboard(Request $request)
    {

        $projects = Project::with(['sectors'])->latest()->get();
        
        if($request->has('sector_id')){
            $projects = Project::with(['sectors'])->where('sector_id', $request->sector_id)->latest()->get();
        }

        $sectors = Sector::whereNull('parent_id')->get();
        $totalEntrepreneur = User::where('user_type_id',2)->count();

        $project_financial = ProjectFinancial::whereHas('projects' , function ($q){
            $q->where('is_published',1);
        });

        $data['total_projects'] = number_format(Project::where('is_published',1)->count());
        $data['total_funds_needed'] = number_format($project_financial->sum('current_target_to_raise'));
        $data['total_funds_raised'] = number_format($project_financial->sum('raised_so_far'));
        $data['total_investors'] = number_format(User::where('user_type_id',1)->count());
        $data['total_funds_pledged'] = number_format(ProjectInvestor::whereHas('projects' , function ($q){
            $q->where('is_published',1);
        })->sum('invest_amount'));

        $data['sectors'] = $sectors;
        $data['totalEntrepreneur'] = $totalEntrepreneur;

        // dd($data);

        // echo "<pre>"; var_dump($data); die;
        return view('dashboard', $data);
    }

    public function getProjectDetail($id)
    {
        $data = Project::where('id',$id)->with(['sectors','city','stages','partnershipType','projectEntrepreneur','financials','teams','contactUs'])->first();

        return view('detailed_page', ['projects' => $data]);
    }

    public function destroy(Project $project)
    {
        try {
            return $project->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
