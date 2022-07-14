<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{
    use HasFactory;

    protected $table = 'user_informations';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'is_anonymous',
        'partment_id',
        'position_level_id',
    ];

    /**
     * userInfo belongs to a user
     */
    public function user()
    {
        return $this->belongsTo(User::class,'id','id');
    }

    /**
     * a user has a partment
     */
    public function partment()
    {
        return $this->belongsTo(UserPartment::class,'partment_id','id');
    }

    /**
     * a user has a level
     * level 跟 投票权重挂钩
     */
    public function positionLevel()
    {
        return $this->belongsTo(UserPositionLevel::class,'position_level_id','id');
    }

    /**
     * is anonymous ?
     * return 1 or 0
     */
    public function getIsAnonymous()
    {
        if($this->is_anonymous == 1)
            return 1;
        else
            return 0;
    }

    
}
