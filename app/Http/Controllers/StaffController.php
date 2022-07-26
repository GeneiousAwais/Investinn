<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Database\QueryException;
use DataTables;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
             $data = User::where('user_type_id',4)->get();
             // dd($data->toArray());
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                return ($row->is_active == 'inactive') ? '<span class="badge badge-outline-danger">  Inactive </span>' : '<span class="badge badge-outline-success">Active</span>';
            })
            ->addColumn('action', function ($row) {
                return view('staff.actions',['row'=>$row]);
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
        }
        return view('staff.staff');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staffs = UserType::where('id',4)->get();

        $data = [
            'personaldetails' => 'active',
            'staffs'=> $staffs
        ];
        
        return view('staff.add_new_staff_form',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $staff = UserType::where('id',4)->get();
        $user_info = User::where('id', $id)->first();
        
        $data = [
            'personaldetails' => 'active',
            'staffs'=> $staff,
            'user_info' => $user_info,
        ];


        return view('staff.add_new_staff_form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staff $staff)
    {
        //
    }
}
