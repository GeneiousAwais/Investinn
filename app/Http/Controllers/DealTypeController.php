<?php

namespace App\Http\Controllers;

use App\Models\DealType;
use Illuminate\Http\Request;
use DataTables;

class DealTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DealType::get();
            // dd($data);
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                return ($row->is_active == 'inactive') ? '<span class="badge badge-outline-danger">  Inactive </span>' : '<span class="badge badge-outline-success">Active</span>';
            })
            ->addColumn('action', function ($row) {
                return view('settings.deal_types.actions',['row'=>$row]);
            })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        return view('settings.deal_types.deal_types');
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
            'title' => 'required|unique:deal_types,title'
        ]);

        DealType::create($request->all());

        return redirect()->route('deal-types.index')
            ->with('success', 'Deal types created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DealType  $dealType
     * @return \Illuminate\Http\Response
     */
    public function show(DealType $dealType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DealType  $dealType
     * @return \Illuminate\Http\Response
     */
    public function edit(DealType $dealType)
    {
        return view('settings.deal_types.deal_types', ['dealType' => $dealType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DealType  $dealType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DealType $dealType)
    {
        $request->validate([
            'title' => 'required|unique:deal_types,title,' . $dealType->id,
        ]);

        $dealType->update($request->all());

        return redirect()->route('deal-types.index')->with('success', 'Deal types updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DealType  $dealType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DealType $dealType)
    {
        try {
            return $dealType->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
