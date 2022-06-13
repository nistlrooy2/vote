<?php

namespace App\Http\Controllers;

use App\Models\VoteList;
use App\Http\Requests\StoreVoteListRequest;
use App\Http\Requests\UpdateVoteListRequest;

class VoteListController extends Controller
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
     * @param  \App\Http\Requests\StoreVoteListRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVoteListRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VoteList  $voteList
     * @return \Illuminate\Http\Response
     */
    public function show(VoteList $voteList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VoteList  $voteList
     * @return \Illuminate\Http\Response
     */
    public function edit(VoteList $voteList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVoteListRequest  $request
     * @param  \App\Models\VoteList  $voteList
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVoteListRequest $request, VoteList $voteList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VoteList  $voteList
     * @return \Illuminate\Http\Response
     */
    public function destroy(VoteList $voteList)
    {
        //
    }
}
