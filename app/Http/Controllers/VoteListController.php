<?php

namespace App\Http\Controllers;

use App\Http\Controllers\VoyagerBaseController;
use Illuminate\Http\Request;
use App\Models\VoteList;
use Illuminate\Support\Facades\Auth;
use App\Models\UserPartment;

class VoteListController extends VoyagerBaseController
{
    //
    public function voteListIndex($id)
    {
        $voteList = VoteList::where('id',$id)
                            ->first();

        $vote = VoteList::find($id)->vote()->get();

        return view('vote.vote-list')
                ->with('vote', $vote)
                ->with('voteList', $voteList);
    }

    /**
     * create vote list
     * form
     */
    public function voteListCreate()
    {
        //get all partment info
        $partment = UserPartment::all();

        //check permission
        if($this->checkPermission('add_vote_lists'))
            return view('vote.vote-list-create',compact('partment'));
        else
            abort(403);
        
    }

    public function voteListStore(Request $request)
    {

    }
}
