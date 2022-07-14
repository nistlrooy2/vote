<?php

namespace App\Http\Controllers;
use App\Http\Controllers\VoyagerBaseController;
use Illuminate\Http\Request;
use App\Models\UserInformation;

class UserInformationController extends VoyagerBaseController
{
    
    /**
     * test
     */
    public function indexall(Request $request)
    {
        $partment = UserInformation::get();
        return dump($partment);
    }
}
