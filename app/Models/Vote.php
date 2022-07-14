<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'vote_list_id',
        'selectable_number',
    ];

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
    public function voteOption()
    {
        return $this->hasMany(VoteOption::class,'vote_id','id');
    }

    public function voteResult()
    {
        return $this->hasOne(VoteResult::class,'vote_id','id');
    }

    /**
     * many to many
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'votes_users', 'vote_id', 'user_id');
    }

    
}
