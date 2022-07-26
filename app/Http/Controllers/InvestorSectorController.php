<?php

namespace App\Http\Controllers;

use App\Models\InvestorSector;
use Illuminate\Http\Request;
use App\Models\Sector;
use DataTables;

class InvestorSectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = InvestorSector::where('user_id',$request->user_id)->with(['sectors','subSectors'])->get();
            // dd($data->toArray());
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return view('investors.inv_sector_action',['row'=>$row]);
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return redirect(route('shareholders.edit', $request->user_id) . '?tab=sectors')->with('success', 'Investor other details has been saved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $input = $request->all();
        $exist_record ='';
        if($request->id){
            $exist_record = InvestorSector::find($request->id);
        }


        
        if($exist_record){
            $exist_record->update($input);
        }
        else{
            $input['user_id'] = $request->user_id;
            InvestorSector::create($input);
        }
        return redirect(route('shareholders.edit', $request->user_id) . '?tab=sectors')->with('success', 'Investor sectors has been saved successfully.');
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
        $sub_sectors = isset($data['sub_sector_id']) ? $data['sub_sector_id'] : '';

        if(is_array($sub_sectors) && !empty($sub_sectors)){

            foreach ($sub_sectors as $key => $value) {
                $data['sub_sector_id'] = $value;
                InvestorSector::create($data);
            }

        }else{
           InvestorSector::create($data); 
        }
        return redirect(route('shareholders.edit', $request->user_id) . '?tab=sectors')->with('success', 'Sectors & Sub sectors successfully saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InvestorSector  $investorSector
     * @return \Illuminate\Http\Response
     */
    public function show(InvestorSector $investorSector)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvestorSector  $investorSector
     * @return \Illuminate\Http\Response
     */
    public function edit(InvestorSector $investorSector)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InvestorSector  $investorSector
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, InvestorSector $investorSector)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvestorSector  $investorSector
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $investorSector = InvestorSector::findOrFail($id);

        try {
            $investorSector->delete();
            return 'remove sector';
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
