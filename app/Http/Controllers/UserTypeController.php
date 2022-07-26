<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use Illuminate\Http\Request;
use DataTables;

class UserTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = UserType::get();
            // dd($data);
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                return ($row->is_active == 'inactive') ? '<span class="badge badge-outline-danger">  Inactive </span>' : '<span class="badge badge-outline-success">Active</span>';
            })
            ->addColumn('action', function ($row) {
                return view('settings.user_types.actions',['row'=>$row]);
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
        }
        return view('settings.user_types.user_types');
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
        $request->validate([
            'user_name' => 'required|unique:user_types,user_name'
        ]);

        UserType::create($request->all());

        return redirect()->route('user-types.index')
            ->with('success', 'user types created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserType  $userType
     * @return \Illuminate\Http\Response
     */
    public function show(UserType $userType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserType  $userType
     * @return \Illuminate\Http\Response
     */
    public function edit(UserType $userType)
    {
        return view('settings.user_types.user_types', ['userType' => $userType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserType  $userType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserType $userType)
    {
        $request->validate([
            'user_name' => 'required|unique:user_types,user_name,' . $userType->id,
        ]);

        $userType->update($request->all());

        return redirect()->route('user-types.index')->with('success', 'user types updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserType  $userType
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserType $userType)
    {
         try {
            return $userType->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
