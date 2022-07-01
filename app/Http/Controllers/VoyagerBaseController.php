<?php

namespace App\Http\Controllers;

use TCG\Voyager\Http\Controllers\VoyagerBaseController as BaseVoyagerBaseController;
use Illuminate\Support\Facades\Auth;

class VoyagerBaseController extends BaseVoyagerBaseController
{
    /**
     * check permission 
     */
    public function checkPermission($permission_name)
    {
        $user = Auth::user();
        if($user->hasPermission($permission_name))
            return True;
        else
            return False;
    }
}
