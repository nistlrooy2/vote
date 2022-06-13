<?php

namespace App\Http\Controllers;

use App\Models\UserPartment;
use App\Http\Requests\StoreUserPartmentRequest;
use App\Http\Requests\UpdateUserPartmentRequest;

class UserPartmentController extends Controller
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
     * @param  \App\Http\Requests\StoreUserPartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserPartmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserPartment  $userPartment
     * @return \Illuminate\Http\Response
     */
    public function show(UserPartment $userPartment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserPartment  $userPartment
     * @return \Illuminate\Http\Response
     */
    public function edit(UserPartment $userPartment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserPartmentRequest  $request
     * @param  \App\Models\UserPartment  $userPartment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserPartmentRequest $request, UserPartment $userPartment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserPartment  $userPartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserPartment $userPartment)
    {
        //
    }
}
