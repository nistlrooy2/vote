<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoteWeight extends Model
{
    use HasFactory;

    /**
     * 关联vote
     */
    public function vote()
    {
        return $this->belongsTo(Vote::class,'vote_id','id');
    }
}
