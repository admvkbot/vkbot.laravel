<?php

namespace App\Http\Controllers\Bot\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Bot\BaseController as MainBaseController;

abstract class AdminBaseController extends MainBaseController
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('status');


    }

}
