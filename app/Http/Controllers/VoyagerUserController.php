<?php

namespace App\Http\Controllers;

use TCG\Voyager\Http\Controllers\VoyagerUserController as BaseVoyagerUserController;
use App\Models\UserPositionLevel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Http\Requests\CreateAnonymousRequest;
use App\Exports\AnonymousExport;
use App\Models\UserInfomation;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Exception;

class VoyagerUserController extends BaseVoyagerUserController
{
    //
    public function anonymousCreate()
    {
        //check permission
        if($this->checkPermission('add_users'))
        {
            //get all partment info
            $user_level = UserPositionLevel::all();
            return view('vote.user-anonymous-create',compact('user_level'));
        }      
        else
            abort(403,"无创建匿名用户权限");
    }

    public function anonymousStore(CreateAnonymousRequest $request)
    {
        //check permission
        if($this->checkPermission('add_users'))
        {
            $number = $request->input('number');
            $level = $request->input('level');

            $email_length = 8;//define random string length
            $password_length = 6;
            $suffix = "@a.cn";//email后缀
            $users = array();
            $users[0]['email']="邮箱名";
            $users[0]['password']="密码";

            $user_level = UserPositionLevel::all();
            $level_info = array();
            foreach($user_level as $l)
            {
                $level_info[$l['id']]=$l['name'];
            }
           
            DB::beginTransaction();
            try
            {

                for($i=1;$i<=$number;$i++)
                {
                    $email = $this->genGoodRandString($email_length).$suffix;
                    //if this email exist , random another
                    while($this->hasUser($email))
                    {
                        $email = $this->genGoodRandString($email_length).$suffix;
                    }
                    $password = $this->genGoodRandString($password_length);
                    $users[$i]['email'] = $email;
                    $users[$i]['password'] = $password;
    
                    $user_name = "匿名".$level_info[$level];

                    $user = User::create([
                        'name' => $user_name,
                        'email' => $email,
                        'password' => Hash::make($password),
                    ]);

                    $user_id = $user->id;

                    $user_info = UserInfomation::create([
                        'id' => $user_id,
                        'is_anonymous' => 1,
                        'partment_id' => 0,
                        'position_level_id' => $level,
                    ]);

                    DB::table('anonymous_users')->insert([
                        ['id' => $user_id, 'name'=>$user_name,'password'=>$password,'has_voted' => 0,'created_at'=>now(),'updated_at'=>now()],
                    ]);
                }
            }
            catch(Exception $e)
            {
                DB::rollBack();
                throw $e;
                abort(500,"DB rollback");
            }
            DB::commit();
            
            $export = new AnonymousExport($users);
            return Excel::download($export, 'anonymous.xlsx');
            /*
            die();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            */
        }      
        else
            abort(403,"无创建匿名用户权限");
    }

    /**
     * check permission 
     */
    private function checkPermission($permission_name)
    {
        $user = Auth::user();
        if($user->hasPermission($permission_name))
            return True;
        else
            return False;
    }


    /**
     * get random unique string
     */
    private function genGoodRandString($length) 
    {
        if($length>31||$length<1)
            $length = 31;
        $rnd_id = md5(uniqid(rand(), true)); // get long random id
        $bad = array('0','o','1','l','z'); // define bad chars
        $fixed = str_replace($bad, '', $rnd_id); // fix
        return substr($fixed, 0, $length); // cut to required length
    }

    /**
     * check if has user with this email
     */
    private function hasUser($email)
    {
        $user = User::where('email',$email)->first();
        if($user == null)
            return false;
        else
            return true;
    }


}
