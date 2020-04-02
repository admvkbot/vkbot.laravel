<?php

namespace App\Http\Controllers\Bot\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Admin\MainRepository;
use App\Repositories\Admin\FriendRepository;
use App\Repositories\Admin\MessageRepository;

class MainController extends AdminBaseController
{

    private $messageRepository;
    private $friendRepository;

    public function __construct()
    {
        parent::__construct();
        $this->messageRepository = app(MessageRepository::class);
        $this->friendRepository = app(FriendRepository::class);
    }

    public function index(){

        $countTasks = MainRepository::getCountTasks();
        $countActiveTasks = MainRepository::getCountActiveTasks();
        $countUnreadMessages = MainRepository::getCountUnreadMessages();
        $countNewFriends = MainRepository::getCountNewFriends();

        $perpage = 10;

        $last_messages = $this->messageRepository->getNewMessages($perpage);
        $last_friends = $this->friendRepository->getNewFriends($perpage);

        return view('bot.admin.main.index', compact(
            'countTasks',
            'countActiveTasks',
            'countUnreadMessages',
            'countNewFriends',
            'last_messages',
            'last_friends'
            ));
    }


}
