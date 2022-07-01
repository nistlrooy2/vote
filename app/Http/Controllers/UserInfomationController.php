<?php

namespace App\Http\Controllers;
use App\Http\Controllers\VoyagerBaseController;
use Illuminate\Http\Request;
use App\Models\UserInfomation;

class UserInfomationController extends VoyagerBaseController
{
    
    /**
     * test
     */
    public function indexall(Request $request)
    {
        $partment = UserInfomation::get();
        return dump($partment);
    }
}
