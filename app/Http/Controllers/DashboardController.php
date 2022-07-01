<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VoteList;
use App\Models\UserPartment;
use App\Models\UserInfomation;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * 
     */
    public function index(Request $request)
    {
        // get the current userInfo
        $user = Auth::user();
        $userInfo = $user->userInfomation()->first();
        //if current user doesn't have userinfo , create the info
        if(!$userInfo)
        {
            $newUserInfo = new UserInfomation(['id'=>Auth::id(),
                                                'is_anonymous'=>0,
                                                'partment_id'=>0,//no partment
                                                'position_level_id'=>0]);//no position level
            $user->userInfomation()->save($newUserInfo);
            $user->refresh();
            $userInfo = $user->userInfomation()->first();
        }
        
        // is Anonymous?
        $is_anonymous = $userInfo->getIsAnonymous();
        
        $partment_id = $userInfo['partment_id'];
        $userPartment = UserPartment::find($partment_id);

        //if userparment dones't exist , partment_id_collect is collect([])
        if(!$userPartment)
        {
            $partment_id_collect = collect([]);
        }
        else//else find the parent's id and so on
        {
            $partment_id_collect = $userPartment->getParentPartment($partment_id);
        }

        //$position_level_id = $userInfo['position_level_id'];

        $voteList = VoteList::where('start_time', '<', now())
                            ->where('end_time', '>', now())
                            ->where('is_anonymous',$is_anonymous)
                            ->get();
        //$number = $voteList->count();

        return view('dashboard',compact('partment_id_collect',
                                        'voteList',));
    }

}
