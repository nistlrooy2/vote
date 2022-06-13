<?php

namespace App\Http\Controllers;

use App\Models\VoteOption;
use App\Http\Requests\StoreVoteOptionRequest;
use App\Http\Requests\UpdateVoteOptionRequest;

class VoteOptionController extends Controller
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
     * @param  \App\Http\Requests\StoreVoteOptionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVoteOptionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VoteOption  $voteOption
     * @return \Illuminate\Http\Response
     */
    public function show(VoteOption $voteOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VoteOption  $voteOption
     * @return \Illuminate\Http\Response
     */
    public function edit(VoteOption $voteOption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVoteOptionRequest  $request
     * @param  \App\Models\VoteOption  $voteOption
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVoteOptionRequest $request, VoteOption $voteOption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VoteOption  $voteOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(VoteOption $voteOption)
    {
        //
    }
}
