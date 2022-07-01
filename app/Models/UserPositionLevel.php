<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPositionLevel extends Model
{
    use HasFactory;

    /**
     * level belongs to userInfo
     */
    public function userInfomation()
    {
        return $this->hasMany(UserInfomation::class,'position_level_id','id');
    }
}
