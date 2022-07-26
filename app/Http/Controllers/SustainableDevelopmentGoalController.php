<?php

namespace App\Http\Controllers;

use App\Models\SustainableDevelopmentGoal;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use DataTables;

class SustainableDevelopmentGoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SustainableDevelopmentGoal::get();
            // dd($data);
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                return ($row->is_active == 'inactive') ? '<span class="badge badge-outline-danger">  Inactive </span>' : '<span class="badge badge-outline-success">Active</span>';
            })
            ->addColumn('action', function ($row) {
                return view('settings.sustainable-development-goals.actions',['row'=>$row]);
            })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        return view('settings.sustainable-development-goals.sdgs');
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
            'sdg_name' => 'required|unique:sustainable_development_goals,sdg_name,',
            'is_active' => 'required'
        ]);
        $data = $request->all();

        if ($request->base64data) {
            $path = public_path() . '/files/sdg/';
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
            $data['icon_name'] = $imageName;
        }

        SustainableDevelopmentGoal::create($data);

        return redirect()->route('sustainable-development-goals.index')
            ->with('success', 'SDG created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SustainableDevelopmentGoal  $sustainableDevelopmentGoal
     * @return \Illuminate\Http\Response
     */
    public function show(SustainableDevelopmentGoal $sustainableDevelopmentGoal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SustainableDevelopmentGoal  $sustainableDevelopmentGoal
     * @return \Illuminate\Http\Response
     */
    public function edit(SustainableDevelopmentGoal $sustainableDevelopmentGoal)
    {
        return view('settings.sustainable-development-goals.sdgs', ['sdg' => $sustainableDevelopmentGoal]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SustainableDevelopmentGoal  $sustainableDevelopmentGoal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SustainableDevelopmentGoal $sustainableDevelopmentGoal)
    {
        $request->validate([
            'sdg_name' => 'required|unique:sustainable_development_goals,sdg_name,' . $sustainableDevelopmentGoal->id,
            'is_active' => 'required'
        ]);

        $data = $request->all();

        if ($request->base64data) {
            $path = public_path() . '/files/sdg/';
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
            $data['icon_name'] = $imageName;
        }


        $sustainableDevelopmentGoal->update($data);

        return redirect()->route('sustainable-development-goals.index')->with('success', 'SDG updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SustainableDevelopmentGoal  $sustainableDevelopmentGoal
     * @return \Illuminate\Http\Response
     */
    public function destroy(SustainableDevelopmentGoal $sustainableDevelopmentGoal)
    {
        try {
            return $sustainableDevelopmentGoal->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
