<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Volunteer;
use App\Models\User;
use App\Models\UserType;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use DataTables;

class VolunteerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
             $data = User::where('user_type_id',5)->orderBy('id', 'DESC')->get();
             // dd($data->toArray());
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                return ($row->is_active == 'inactive') ? '<span class="badge badge-outline-danger">  Inactive </span>' : '<span class="badge badge-outline-success">Active</span>';
            })
            ->addColumn('verification_status', function ($row) {
                return is_null($row->email_verified_at) ? '<span class="badge badge-outline-danger">Not Verified</span>' : '<span class="badge badge-outline-success">Verified</span>';
            })
            ->addColumn('action', function ($row) {
                return view('volunteers.actions',['row'=>$row]);
            })
            ->rawColumns(['action', 'verification_status','status'])
            ->make(true);
        }
        return view('volunteers.volunteer');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $volunteers = UserType::where('id',5)->get();

        $data = [
            'personaldetails' => 'active',
            'volunteers'=> $volunteers
        ];
        return view('volunteers.add_new_volunteer_form',$data);
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
        $exist_record = Volunteer::where('user_id',$request->user_id)->first();
        if($exist_record){
            $exist_record->update($data);
        }
        else{
            Volunteer::create($data);
        }
        return redirect(route('volunteers.index'))->with('success', 'Volunteers other detail has been saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function show(Volunteer $volunteer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_info = User::where('id', $id)->first();

        $volunteer = Volunteer::where('user_id', $id)->with(['user'])->first();
        $data = [
            'personaldetails' => 'active',
            'volunteer' => $volunteer,
            'user_info' => $user_info
        ];

        // dd($data);
        return view('volunteers.add_new_volunteer_form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Volunteer $volunteer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Volunteer $volunteer)
    {
        //
    }
}
