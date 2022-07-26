<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Exports\ExportCity;
use DataTables;
use App\Imports\ImportCity;
use Excel;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Sector::with('parent')->get();
            // dd($data);
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                return ($row->is_active == 'inactive') ? '<span class="badge badge-outline-danger">  Inactive </span>' : '<span class="badge badge-outline-success">Active</span>';
            })
            ->addColumn('action', function ($row) {
                return view('settings.sectors.actions',['row'=>$row]);
            })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        $sectors = Sector::where('parent_id', null)->get();
        return view('settings.sectors.sectors',compact('sectors'));
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
        // $request->validate([
        //     'sector_name' => 'required|unique:sectors,sector_name'
        // ]);
        $data = $request->all();
        if ($request->base64data) {
            $path = public_path() . '/files/sectors/';
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

        Sector::create($data);

        return redirect()->route('sectors.index')
            ->with('success', 'Sector created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function show(Sector $sector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function edit(Sector $sector)
    {
        $parents = Sector::where('parent_id', null)->get();
        return view('settings.sectors.sectors', ['sector' => $sector,'parents' => $parents]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sector $sector)
    {
        // $request->validate([
        //     'sector_name' => 'required|unique:sectors,sector_name,' . $sector->id,
        // ]);

        $data = $request->all();
        if ($request->base64data) {
            $path = public_path() . '/files/sectors/';
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


        $sector->update($data);

        return redirect()->route('sectors.index')->with('success', 'Sector updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */

    public function destroy(Sector $sector)
    {
        try {
            return $sector->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
