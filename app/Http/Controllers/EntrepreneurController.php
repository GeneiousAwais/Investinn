<?php

namespace App\Http\Controllers;

use App\Models\Entrepreneur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\UserType;
use App\Models\CompanyEntrepreneur;

use Illuminate\Database\QueryException;
use DataTables;

class EntrepreneurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
             $data = User::where('user_type_id',2)->get();
             // dd($data->toArray());
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                return ($row->is_active == 'inactive') ? '<span class="badge badge-outline-danger">  Inactive </span>' : '<span class="badge badge-outline-success">Active</span>';
            })
            ->addColumn('action', function ($row) {
                return view('entrepreneur.actions',['row'=>$row]);
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
        }
        return view('entrepreneur.entrepreneur');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $entrepreneur = UserType::where('id',2)->get();

        $data = [
            'personaldetails' => 'active',
            'entrepreneurs'=> $entrepreneur
        ];
        
        return view('entrepreneur.add_new_enterpreneur_form',$data);
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
     * @param  \App\Models\Entrepreneur  $entrepreneur
     * @return \Illuminate\Http\Response
     */
    public function show(Entrepreneur $entrepreneur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entrepreneur  $entrepreneur
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $entrepreneur = UserType::where('id',2)->get();
        $user_info = User::where('id', $id)->first();
        $entrepreneurCompanyInfo = CompanyEntrepreneur::where('user_id',$id)->first();
        
        $data = [
            'personaldetails' => 'active',
            'entrepreneurs'=> $entrepreneur,
            'user_info' => $user_info,
            'entrepreneurCompanyInfo' => $entrepreneurCompanyInfo
        ];


        return view('entrepreneur.add_new_enterpreneur_form', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Entrepreneur  $entrepreneur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entrepreneur $entrepreneur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entrepreneur  $entrepreneur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Entrepreneur $entrepreneur)
    {
        try {
            return $entrepreneur->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
