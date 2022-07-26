<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Models\City;
use App\Exports\ExportCity;
use App\Models\Country;
use DataTables;
use App\Imports\ImportCity;
use Excel;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = City::with('countries')->get();
            // dd($data);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return ($row->is_active == 'inactive') ? '<span class="badge badge-outline-danger">  Inactive </span>' : '<span class="badge badge-outline-success">Active</span>';
                })
                ->addColumn('action', function ($row) {
                    return view('settings.cities.actions',['row'=>$row]);
                })
                ->rawColumns(['action','status'])
                ->make(true);
        }
        $countries = Country::get();
        return view('settings.cities.cities', compact('countries'));
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
            'city_name' => 'required|unique:cities,city_name',
            'is_active' => 'required',
            'country_id' => 'required',
        ]);
        // dd($request);
        City::create($request->all());

        return redirect()->route('cities.index')
            ->with('success', 'City created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        $countries = Country::get();
        return view('settings.cities.cities', ['city' => $city, 'countries' => $countries]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $request->validate([
            'city_name' => 'required|unique:cities,city_name,' . $city->id,
            'country_id' => 'required',
        ]);

        $city->update($request->all());

        return redirect()->route('cities.index')->with('success', 'City updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        try {
            return $city->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }

    public function importCity(Request $request){
        Excel::import(new ImportCity,$request->file('file')->store('files'));
        return redirect()->back();
    }

    public function exportCity(Request $request){
        return Excel::download(new ExportCity,'cities.xlsx');
    }
}
