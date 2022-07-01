<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoteResult extends Model
{
    use HasFactory;

    /**
     * 关联votelist
     */
    public function voteList()
    {
        return $this->belongsTo(VoteList::class,'vote_list_id','id');
    }

    /**
     * 关联vote
     */
    public function vote()
    {
        return $this->belongsTo(Vote::class,'vote_id','id');
    }

}