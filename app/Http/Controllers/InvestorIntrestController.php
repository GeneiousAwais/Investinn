<?php

namespace App\Http\Controllers;

use App\Models\InvestorIntrest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use DataTables;

class InvestorIntrestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_type_id = \Auth::user()->user_type_id;
        $staff_id = \Auth::user()->id;

        // $data = InvestorIntrest::with(['project', 'user'])->get();
        // dd($data->toArray());

        if ($request->ajax()) {

            $data = null;

            if($user_type_id == 1) {                
                $data = InvestorIntrest::where('user_id', $staff_id)->with(['project', 'user'])->orderBy('id', 'DESC')->get();
            } else {
                $data = InvestorIntrest::with(['project', 'user'])->orderBy('id', 'DESC')->get();
            }

            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('investors_interest.actions',['row'=>$row]);
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('investors_interest.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\InvestorIntrest  $investorIntrest
     * @return \Illuminate\Http\Response
     */
    public function show(InvestorIntrest $investorIntrest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvestorIntrest  $investorIntrest
     * @return \Illuminate\Http\Response
     */
    public function edit(InvestorIntrest $investorIntrest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvestorIntrest  $investorIntrest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvestorIntrest $investorIntrest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvestorIntrest  $investorIntrest
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvestorIntrest $investorIntrest)
    {
        //
    }
}
