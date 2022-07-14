<?php

namespace App\Http\Controllers;

use App\Http\Controllers\VoyagerBaseController;
use App\Http\Requests\CreateVoteListRequest;
use Illuminate\Http\Request;
use App\Models\VoteList;
use App\Models\Vote;
use App\Models\VoteOption;
use App\Models\VoteResult;
use App\Models\VoteUser;
use App\Models\UserInformation;
use App\Models\VoteWeight;
use Illuminate\Support\Facades\Auth;
use App\Models\UserPartment;
use Exception;
use Illuminate\Support\Facades\DB;


class VoteListController extends VoyagerBaseController
{
    /**
     * show the votelist vote voteoption info and vote it!
     */
    public function voteListIndex($id)
    {
        $user = Auth::user();
        $user_information = $user->userInformation()->first();

        $user_is_anonymous = $user_information['is_anonymous'];

        $voteList = VoteList::where('id',$id)
                        ->first();
        $is_anonymous = $voteList['is_anonymous'];

        if($user_is_anonymous != $is_anonymous)
        {
            abort(403,"匿名与非匿名投票不可混投");
        }

        $vote = $voteList->vote()->get();
        $option = collect([]);
        foreach($vote as $v)
        {
            $option->push($v->voteOption()->get());
        }
        //dump($option);
        
        return view('vote.vote-list',compact('vote','voteList','option'));
    }

    /**
     * create vote list
     * form
     */
    public function voteListCreate()
    {
        //get all partment info
        $partment = UserPartment::all();

        //check permission
        if($this->checkPermission('add_vote_lists'))
            return view('vote.vote-list-create',compact('partment'));
        else
            abort(403,"无创建投票活动权限");
        
    }

    /**
     * store vote create data
     */
    public function voteListStore(CreateVoteListRequest $request)
    {
        
        //check permission
        if($this->checkPermission('add_vote_lists'))
        {
            DB::beginTransaction();
            try{
                //save new votelist
                $votelist_id =  VoteList::create([
                    'title'=>$request->input('votelist_title'),
                    'description'=>$request->input('votelist_description'),
                    'is_anonymous'=>$request->input('is_anonymous'),
                    'partment_id'=>$request->input('partment'),
                    'start_time'=>$request->input('start_time'),
                    'end_time'=>$request->input('end_time'),
                ])->id;

                $vote_number = count($request->input('vote_title'));
                if($vote_number<1)
                    abort(500,"vote_number < 1");

                for($i=0;$i<$vote_number;$i++)
                {
                    //save new vote
                    $vote_id =  Vote::create([
                        'title'=>$request->input('vote_title')[$i],
                        'description'=>$request->input('vote_description')[$i],
                        'vote_list_id'=>$votelist_id,
                        'selectable_number'=>$request->input('selectable_number')[$i],
                    ])->id;
                    
                    $option_number = count($request->input('vote_option')[$i]);
                    for($j=0;$j<$option_number;$j++)
                    {
                        //save new voteoption
                        $vote_option = VoteOption::create([
                            'value'=>$request->input('vote_option')[$i][$j],
                            'vote_id'=>$vote_id,
                        ]);
                    }

                }
            }catch(Exception $e)
            {
                DB::rollBack();
                throw $e;
                abort(500,"DB rollback");
            }
            DB::commit();
            $msg = "创建投票成功！";
            return view('success',compact('msg'));  
        }
        else{
            abort(403,"无创建投票活动权限");
        }
    }

    /**
     * create votelist result
     */
    public function voteListResultCreate($votelist_id)
    {
        if($this->checkPermission('add_vote_lists'))
        {
            //if votelist is not finished ,abort 403
            $vote_list = VoteList::where('id',$votelist_id)
                                ->where('end_time','<',now())->first();
            if($vote_list==null)
                abort(403,"请耐心等待至截止时间再生成结果");

            
            $result = array();
            $result_with_weight = array();//带权重的结果
            $user_weight = array();
            $vote_user = VoteUser::where('vote_list_id',$votelist_id)->get();
            foreach($vote_user as $key=>$data)
            {
                $vote_id = $data['vote_id'];
                $option_id = $data['option_id'];
                $user_id = $data['user_id'];
                
                //if don't have the user_weight info,get the weight through the Model
                if(!isset($user_weight[$user_id]))
                {
                    $position_level_id = (UserInformation::where('id',$user_id)->first())['position_level_id'];
                    
                    $user_weight[$user_id] = (VoteWeight::where('id',$position_level_id)->first())['weight'];
                }
                $weight = $user_weight[$user_id];
                
                if(isset($result[$vote_id][$option_id]))
                {
                    $result[$vote_id][$option_id] = (float)$result[$vote_id][$option_id] + 1;
                    $result_with_weight[$vote_id][$option_id] = (float)$result_with_weight[$vote_id][$option_id] + $weight;
                }
                else
                {
                    $result[$vote_id][$option_id] = (float)1;
                    $result_with_weight[$vote_id][$option_id] = (float)$weight;
                }

            }
            //merge and json encode
            $vote_result = array('noweight'=>$result,'weight'=>$result_with_weight);
            
            $vote_result = json_encode($vote_result);
            
            $checkcode = md5($vote_result);

            DB::beginTransaction();
            try{
                $r = new VoteResult;
                $r->vote_list_id = $votelist_id;
                $r->result = $vote_result;
                $r->check_code = $checkcode;
                $r->save();
            }catch(Exception $e)
            {
                DB::rollBack();
                throw $e;
                abort(500,"DB rollback");
            }
            DB::commit(); 
            $msg = "生成投票结果成功！";
            return view('success',compact('msg'));
        }
        else
        {
            abort(403,"无生成投票结果权限");
        }
    }


    /**
     * votelist result list index
     */
    public function voteListResult($votelist_id)
    {
        $result = VoteResult::where('vote_list_id',$votelist_id)->first();
        if($result == null)
            abort(500);
        $result = json_decode($result['result']);
        $vote_sum = array();
        $vote_weight_sum = array();
        $noweight = $result->noweight;
        $weight = $result->weight;
        foreach($noweight as $key=>$value)
        {
            //echo("<br/>key:".$key."<br/>");
            $sum = 0;
            $sum_weight = 0;
            foreach($value as $k =>$v)
            {
                //echo("k:".$k."  ");
                //echo("v:".$v."  ");
                $sum = $sum + (int)$v;
                $sum_weight = $sum_weight + $weight->$key->$k;
            }
            $vote_sum[$key]=$sum;
            $vote_weight_sum[$key]=$sum_weight;
        }
        if(!isset($sum))
        {
            $sum = 0;
            $sum_weight = 0;
        }
        //dump($vote_sum);
        //die();
        return view('vote.vote-list-result',compact('weight','noweight','vote_sum','vote_weight_sum')); 
    }

    /**
     * votelist result list
     */
    public function voteResultList()
    {
        $vote_list = VoteList::where('end_time','<',now())->orderByDesc('id')->cursorPaginate(7);
        return view('vote.vote-list-result-list',compact('vote_list')); 
    }
}
