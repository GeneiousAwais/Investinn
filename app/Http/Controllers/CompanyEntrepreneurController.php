<?php

namespace App\Http\Controllers;

use App\Models\CompanyEntrepreneur;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DataTables;

class CompanyEntrepreneurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        
        $exist_record = CompanyEntrepreneur::where('user_id',$request->user_id)->first();

        if ($request->base64data) {
            $path = public_path() . '/files/entrepreneur-company/';
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
            $data['logo'] = $imageName;
        }


        
        if($exist_record){
            $exist_record->update($data);
        }
        else{
            $data['user_id'] = $request->user_id;
            CompanyEntrepreneur::create($data);
        }

         return redirect(route('entrepreneurs.index'))->with('success', 'Entrepreneurs company info has been saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompanyEntrepreneur  $companyEntrepreneur
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyEntrepreneur $companyEntrepreneur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyEntrepreneur  $companyEntrepreneur
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyEntrepreneur $companyEntrepreneur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyEntrepreneur  $companyEntrepreneur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyEntrepreneur $companyEntrepreneur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyEntrepreneur  $companyEntrepreneur
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyEntrepreneur $companyEntrepreneur)
    {
        //
    }
}
