<?php

namespace App\Http\Controllers;

use App\Models\Expertise;
use Illuminate\Http\Request;
use DataTables;
class ExpertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Expertise::get();
            // dd($data);
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                return ($row->is_active == 'inactive') ? '<span class="badge badge-outline-danger">  Inactive </span>' : '<span class="badge badge-outline-success">Active</span>';
            })
            ->addColumn('action', function ($row) {
                return view('settings.expertises.actions',['row'=>$row]);
            })
            ->rawColumns(['action','status'])
            ->make(true);
        }
        return view('settings.expertises.expertises');
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
            'title' => 'required|unique:expertises,title'
        ]);

        Expertise::create($request->all());

        return redirect()->route('expertises.index')
            ->with('success', 'Expertise created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expertise  $expertise
     * @return \Illuminate\Http\Response
     */
    public function show(Expertise $expertise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expertise  $expertise
     * @return \Illuminate\Http\Response
     */
    public function edit(Expertise $expertise)
    {
        return view('settings.expertises.expertises', ['expertise' => $expertise]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expertise  $expertise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expertise $expertise)
    {

        $request->validate([
            'title' => 'required|unique:expertises,title,' . $expertise->id,
        ]);

        $expertise->update($request->all());

        return redirect()->route('expertises.index')->with('success', 'Expertise updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expertise  $expertise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expertise $expertise)
    {
        try {
            return $expertise->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
