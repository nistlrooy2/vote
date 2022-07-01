<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoteList extends Model
{
    use HasFactory;

    /**
     * a vote list has one or many votes
     */
    public function vote()
    {
        return $this->hasMany(Vote::class,'vote_list_id','id');
    }

    
}
