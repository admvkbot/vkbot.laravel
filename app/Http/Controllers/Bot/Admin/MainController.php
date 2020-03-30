<?php

namespace App\Http\Controllers\Bot\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Admin\MainRepository;

class MainController extends AdminBaseController
{


    public function index(){

        $countTasks = MainRepository::getCountTasks();
        $countActiveTasks = MainRepository::getCountActiveTasks();
        $countUnreadMessages = MainRepository::getCountUnreadMessages();
        $countTaskMessages = MainRepository::getCountTasksMessages();

        return view('bot.admin.main.index', compact(
            'countTasks',
            'countActiveTasks',
            'countUnreadMessages',
            'countTaskMessages'
            ));
    }


}
