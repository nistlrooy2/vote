<?php

namespace App\Http\Controllers;

use App\Models\VoteResult;
use App\Http\Requests\StoreVoteResultRequest;
use App\Http\Requests\UpdateVoteResultRequest;

class VoteResultController extends Controller
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
     * @param  \App\Http\Requests\StoreVoteResultRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVoteResultRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VoteResult  $voteResult
     * @return \Illuminate\Http\Response
     */
    public function show(VoteResult $voteResult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VoteResult  $voteResult
     * @return \Illuminate\Http\Response
     */
    public function edit(VoteResult $voteResult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVoteResultRequest  $request
     * @param  \App\Models\VoteResult  $voteResult
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVoteResultRequest $request, VoteResult $voteResult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VoteResult  $voteResult
     * @return \Illuminate\Http\Response
     */
    public function destroy(VoteResult $voteResult)
    {
        //
    }
}
