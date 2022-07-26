<?php

namespace App\Http\Controllers;

use App\Models\InvestmentRange;
use Illuminate\Http\Request;
use DataTables;

class InvestmentRangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = InvestmentRange::get();
            // dd($data);
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($row) {
                return ($row->is_active == 'inactive') ? '<span class="badge badge-outline-danger">  Inactive </span>' : '<span class="badge badge-outline-success">Active</span>';
            })
            ->addColumn('range_value', function ($row) {
                return is_null($row->range_value) ? '<span class="badge badge-outline-danger">N/A</span>' : number_format($row->range_value);
            })
            ->addColumn('action', function ($row) {
                return view('settings.investment_ranges.actions',['row'=>$row]);
            })
            ->rawColumns(['action','range_value','status'])
            ->make(true);
        }
        return view('settings.investment_ranges.investment_ranges');
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
            'title' => 'required|unique:investment_ranges,title',
            'range_value' => 'required'
        ]);

        InvestmentRange::create($request->all());

        return redirect()->route('investment-ranges.index')
            ->with('success', 'Investment Ranges created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InvestmentRange  $investmentRange
     * @return \Illuminate\Http\Response
     */
    public function show(InvestmentRange $investmentRange)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvestmentRange  $investmentRange
     * @return \Illuminate\Http\Response
     */
    public function edit(InvestmentRange $investmentRange)
    {
        return view('settings.investment_ranges.investment_ranges', ['investmentRange' => $investmentRange]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvestmentRange  $investmentRange
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvestmentRange $investmentRange)
    {
        $request->validate([
            'title' => 'required|unique:investment_ranges,title,' . $investmentRange->id,
            'range_value' => 'required'
        ]);

        $investmentRange->update($request->all());

        return redirect()->route('investment-ranges.index')->with('success', 'Investment Range updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvestmentRange  $investmentRange
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvestmentRange $investmentRange)
    {
        try {
            return $investmentRange->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
