<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Investor;
use App\Models\User;
use App\Models\Expertise;
use App\Models\Country;
use App\Models\InvestmentRange;
use App\Models\Sector;
use App\Models\UserType;
use App\Models\UserExpertise;
use App\Models\InvestorSector;
use App\Models\SustainableDevelopmentGoal;
use App\Models\ProjectInvestor;
use App\Models\ProjectSdg;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

use DataTables;

class InvestorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
             $data = User::where('user_type_id',1)->orderBy('id', 'DESC')->get();
             // dd($data->toArray());
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('verification_status', function ($row) {
                return is_null($row->email_verified_at) ? '<span class="badge badge-outline-danger">Not Verified</span>' : '<span class="badge badge-outline-success">Verified</span>';
            })
            ->addColumn('action', function ($row) {
                return view('investors.actions',['row'=>$row]);
            })
            ->rawColumns(['action', 'verification_status'])
            ->make(true);
        }
        return view('investors.investors');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sectors = Sector::where('parent_id',null)->get();
        $sub_sectors = Sector::where('parent_id','!=',null)->get();
        $expertises = Expertise::get();
        $countries = Country::get();
        $investmentRanges = InvestmentRange::get();
        $userTypes = UserType::get();
        $investor = UserType::where('id',1)->get();
        $entrepreneur = UserType::where('id',2)->get();
        $consultant = UserType::where('id',3)->get();
        $sdgs= SustainableDevelopmentGoal::get();




        $data = [
            'personaldetails' => 'active',
            'sectors' => $sectors,
            'sub_sectors' => $sub_sectors,
            'expertises' => $expertises,
            'countries' => $countries,
            'investmentRanges' => $investmentRanges,
            'userTypes' => $userTypes,
            'investorTypes'=> $investor,
            'entrepreneurs'=> $entrepreneur,
            'consultants'=> $consultant,
            'sdgs' => $sdgs
        ];
        
        return view('investors.add_new_investor_form',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user_expertise = NULL;
        $data = $request->all();
        // dd($data);

        $exist_record = Investor::where('user_id',$request->user_id)->first();
        $user_expertise_exist = UserExpertise::where('user_id',$request->user_id)->exists();


        if(isset($request->terms_and_condition) && $request->terms_and_condition == 'on' )
        {
            $data['terms_and_condition'] = 'yes';
        }
        else
        {
            $data['terms_and_condition'] = 'no';
        }
        
        if ($request->base64data) {
            $path = public_path() . '/files/investors_picture/';
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
            $data['picture'] = $imageName;
        }

        

        if($exist_record){
            $exist_record->update($data);
        }
        else{
            Investor::create($data);
        }

        

        if($request->expertise_id)
        {

            if($user_expertise_exist)
            {
                $record_del = UserExpertise::where('user_id', $request->user_id)->delete();
                if($record_del)
                {

                    foreach ($request->expertise_id as $key => $value) {
                        $user_expertise['user_id']=$request->user_id;
                        $user_expertise['expertise_id']=$value;
                        UserExpertise::create($user_expertise);

                    }
                }

            }
            else
            {

                foreach ($request->expertise_id as $key => $value) {
                    $user_expertise['user_id']=$request->user_id;
                    $user_expertise['expertise_id']=$value;
                    UserExpertise::create($user_expertise);

                }
            }
        }

        return redirect(route('shareholders.edit', $request->user_id ) . '?tab=sectors')->with('success', 'User other detail has been saved successfully.');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Investor  $investor
     * @return \Illuminate\Http\Response
     */
    public function show(Investor $investor)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Investor  $investor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($investor->toArray());
        $sectors = Sector::where('parent_id',null)->get();
        $sub_sectors = Sector::where('parent_id','!=',null)->get();
        $expertises = Expertise::get();
        $userExpertises = UserExpertise::where('user_id', $id)->get();
        $countries = Country::get();
        $investmentRanges = InvestmentRange::get();
        $userTypes = UserType::get();
        $investors = UserType::where('id',1)->get();
        $entrepreneur = UserType::where('id',2)->get();
        $consultant = UserType::where('id',3)->get();
        $user_info = User::where('id', $id)->first();
        $investor_info = Investor::where('user_id', $id)->first();
        $sdg = '';
        $userSectorsCount = InvestorSector::select('sector_id')->distinct()->where('user_id',$id)->count();
        $investor_investment_total = ProjectInvestor::where('project_investor',$id)->sum('invest_amount');

        if(isset($request->sgd_id)){
            $sdg = SustainableDevelopmentGoal::where('id',$request->sgd_id)->first();
        }

        $investorSdgs = ProjectSdg::where('commentable_id',$id)->pluck('sdg_id');
        $sdgs= SustainableDevelopmentGoal::whereNotIn('id', $investorSdgs)->get();

        $data = [
            'personaldetails' => 'active',
            'sectors' => $sectors,
            'sub_sectors' => $sub_sectors,
            'expertises' => $expertises,
            'userExpertises' => $userExpertises,
            'countries' => $countries,
            'investmentRanges' => $investmentRanges,
            'userTypes' => $userTypes,
            'investorTypes'=> $investors,
            'entrepreneurs'=> $entrepreneur,
            'consultants'=> $consultant,
            'user_info' => $user_info,
            'investor_info' => $investor_info,
            'userSectorsCount' => $userSectorsCount,
            'sdg' => $sdg,
            'sdgs' => $sdgs,
            'investor_investment_total' => $investor_investment_total
        ];


        return view('investors.add_new_investor_form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Investor  $investor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Investor $investor)
    {
        dd($request->all());
    }

    public function archivedInvestors(Request $request)
    {
        if ($request->ajax()) {

             $data = User::onlyTrashed()->where('user_type_id',1)->orderBy('id', 'DESC')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('investors.restore',['row'=>$row]);
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('investors.archived_investors');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Investor  $investor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Investor $investor)
    {
        //
    }
}
