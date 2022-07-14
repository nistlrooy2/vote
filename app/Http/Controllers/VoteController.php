<?php

namespace App\Http\Controllers;

use App\Http\Controllers\VoyagerBaseController;
use Illuminate\Http\Request;
use App\Http\Requests\VoteRequest;
use App\Models\VoteUser;
use App\Models\VoteOption;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class VoteController extends VoyagerBaseController
{
    /**
     * proccess the vote act
     */
    public function voteStore(VoteRequest $request)
    {
        
        $options = $request->input('option');
        $votelist_id = 0;
        $user_id = Auth::id();
        DB::beginTransaction();
        try
        {
            foreach($options as $index=>$option)
            {
                //check the options' vote id
                $vote_id = VoteController::check_vote_id($option);
                
                if($votelist_id==0)
                {
                    $vote = Vote::where('id',$vote_id)->first();
                    $votelist_id = $vote['vote_list_id'];
                }
                //check is voted at first time
                if(VoteController::is_voted($votelist_id,$user_id)&&($index==0))
                {
                    abort(403,"不可重复投票");
                }

                if($vote_id)
                {
                    $checkcode = VoteController::create_checkcode($option,$vote_id,$user_id);
                    
                    
                    foreach($option as $o)
                    {
                        $option_obj = new VoteUser;
                        $option_obj->vote_id = $vote_id;
                        $option_obj->option_id = $o;
                        $option_obj->user_id = $user_id;
                        $option_obj->check_code = $checkcode;
                        $option_obj->vote_list_id = $votelist_id;
                        $option_obj->save();
                    }
                    
                }
                else{
                    abort(500);
                }
            }
        }
        catch(Exception $e)
        {
            DB::rollBack();
            throw $e;
            abort(500);
        }
        DB::commit();
        $msg = "投票成功！";
        return view('success',compact('msg'));
    }

    /**
     * check the option comes from the same vote
     * the same return vote_id
     * not the same return false
     */
    private function check_vote_id($array)
    {
        $vote_id = 0;
        foreach($array as $key=>$id)
        {
            $option = VoteOption::where("id",$id)->first();
            if($key==0)
            {
                $vote_id = $option['vote_id'];
            }
            else
            {
                if($vote_id != $option['vote_id'])
                {
                    return false;
                }
            }
            
        }
        if($vote_id == 0)
            return false;
        return $vote_id;
    }

    /**
     * create checkcode with md5()
     */
    private function create_checkcode($array,$vote_id,$user_id)
    {
        $tmp = 0;
        foreach($array as $option)
        {
            $tmp = $tmp + $option;
        }
        
        return md5($tmp.$vote_id.$user_id);
    }

    /**
     * check is voted
     * if voted return true or return false
     */
    public function is_voted($vote_list_id,$user_id)
    {
        $voted = VoteUser::where('vote_list_id',$vote_list_id)
                    ->where('user_id',$user_id)
                    ->first();
        if($voted == null)
            return false;
        else
            return true;
    }

    
}
