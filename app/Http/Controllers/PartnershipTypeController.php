<?php

namespace App\Http\Controllers;

use App\Models\PartnershipType;
use Illuminate\Http\Request;
use DataTables;

class PartnershipTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = PartnershipType::get();
            // dd($data);
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                return ($row->is_active == 'inactive') ? '<span class="badge badge-outline-danger">  Inactive </span>' : '<span class="badge badge-outline-success">Active</span>';
            })
            ->addColumn('action', function ($row) {
                return view('settings.partnership_types.actions',['row'=>$row]);
            })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        return view('settings.partnership_types.partnership_types');
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
            'title' => 'required|unique:partnership_types,title'
        ]);

        PartnershipType::create($request->all());

        return redirect()->route('partnership-types.index')
            ->with('success', 'partnership types created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PartnershipType  $partnershipType
     * @return \Illuminate\Http\Response
     */
    public function show(PartnershipType $partnershipType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PartnershipType  $partnershipType
     * @return \Illuminate\Http\Response
     */
    public function edit(PartnershipType $partnershipType)
    {
        return view('settings.partnership_types.partnership_types', ['partnershipType' => $partnershipType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PartnershipType  $partnershipType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PartnershipType $partnershipType)
    {
        $request->validate([
            'title' => 'required|unique:partnership_types,title,' . $partnershipType->id,
        ]);

        $partnershipType->update($request->all());

        return redirect()->route('partnership-types.index')->with('success', 'partnership Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PartnershipType  $partnershipType
     * @return \Illuminate\Http\Response
     */
    public function destroy(PartnershipType $partnershipType)
    {
        try {
            return $partnershipType->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
