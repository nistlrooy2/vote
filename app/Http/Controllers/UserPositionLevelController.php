<?php

namespace App\Http\Controllers;

use App\Models\UserPositionLevel;
use App\Http\Requests\StoreUserPositionLevelRequest;
use App\Http\Requests\UpdateUserPositionLevelRequest;

class UserPositionLevelController extends Controller
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
     * @param  \App\Http\Requests\StoreUserPositionLevelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPositionLevelRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPositionLevel  $userPositionLevel
     * @return \Illuminate\Http\Response
     */
    public function show(UserPositionLevel $userPositionLevel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserPositionLevel  $userPositionLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPositionLevel $userPositionLevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserPositionLevelRequest  $request
     * @param  \App\Models\UserPositionLevel  $userPositionLevel
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserPositionLevelRequest $request, UserPositionLevel $userPositionLevel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPositionLevel  $userPositionLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPositionLevel $userPositionLevel)
    {
        //
    }
}
