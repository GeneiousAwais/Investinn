<?php

namespace App\Http\Controllers;

use App\Models\UserExpertise;
use Illuminate\Http\Request;

class UserExpertiseController extends Controller
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
        dd($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserExpertise  $userExpertise
     * @return \Illuminate\Http\Response
     */
    public function show(UserExpertise $userExpertise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserExpertise  $userExpertise
     * @return \Illuminate\Http\Response
     */
    public function edit(UserExpertise $userExpertise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserExpertise  $userExpertise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserExpertise $userExpertise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserExpertise  $userExpertise
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserExpertise $userExpertise)
    {
        //
    }
}
