<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class UserPartment extends Model
{
    use HasFactory;

    /**
     * partment belongs to userInfo
     */
    public function userInformation()
    {
        return $this->hasMany(UserInformation::class,'partment_id','id');
    }

    /**
     * get the parent id  and parent's parent id ,and so on
     * 
     * renturn parents id collect(include itself id)
     */
    public function getParentPartment($id)
    {
        $id_collect = collect([$id]);
        $current_partment_id = $id; 

        while(True)
        {
            //get the parent id
            $parent_partment = $this->where('id',$current_partment_id)
                                    ->first();
            
            $parent_id = $parent_partment['parent_id'];

            //if parent id =0 or =itself id , break
            if($current_partment_id == $parent_id || $parent_id === 0)
                break;
            else
            {
                //else push $parent_id into collect
                $id_collect->push($parent_id);
                $current_partment_id = $parent_id;
            }
            
        }
        return $id_collect;
        
    }
}
