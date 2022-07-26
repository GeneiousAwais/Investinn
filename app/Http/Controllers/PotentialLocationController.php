<?php

namespace App\Http\Controllers;

use App\Models\PotentialLocation;
use App\Models\Project;
use Illuminate\Http\Request;
use DataTables;

class PotentialLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = PotentialLocation::where('project_id',$request->project_id)->with(['projects'])->get();
            // dd($data->toArray());
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('projects.potential_locations.actions',['row'=>$row]);
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return redirect(route('projects.edit', $request->project_id) . '?tab=location')->with('success', 'Project Location has been saved successfully.');
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

        $data = $request->all();
        $request->validate([
            'location_title' => 'required|unique:potential_locations,location_title',
            'full_address' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);
        $data['project_id'] = $request->project_id;
        PotentialLocation::create($data);
        return redirect(route('projects.edit', $request->project_id) . '?tab=location')->with('success', 'Project Location has been saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PotentialLocation  $potentialLocation
     * @return \Illuminate\Http\Response
     */
    public function show(PotentialLocation $potentialLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PotentialLocation  $potentialLocation
     * @return \Illuminate\Http\Response
     */
    public function edit(PotentialLocation $potentialLocation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PotentialLocation  $potentialLocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PotentialLocation $potentialLocation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PotentialLocation  $potentialLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(PotentialLocation $potentialLocation,$id)
    {
        $potentialLocation = PotentialLocation::findOrFail($id);
        try {
            return $potentialLocation->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }


    public function listProjectLocations(Request $request)
    {
        // dd($request->all());
        $data = PotentialLocation::where('project_id',$request->project_id)->get();
        return response()->json($data);
    }


    
}
