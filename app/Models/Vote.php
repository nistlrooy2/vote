<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    /**
     * vote belongs to vote list
     */
    public function voteList()
    {
        return $this->belongsTo(VoteList::class,'vote_list_id','id');
    }

    /**
     * vote has many options
     */
    public function votOption()
    {
        return $this->hasMany(VoteOption::class,'vote_id','id');
    }

    public function voteResult()
    {
        return $this->hasOne(VoteResult::class,'vote_id','id');
    }

    
}
