<?php

namespace App\Http\Controllers\Bot\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends AdminBaseController
{


    public function index(){
        return view('bot.admin.main.index');
    }

}
