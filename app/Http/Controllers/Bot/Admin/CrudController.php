<?php

namespace App\Http\Controllers\Bot\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Message;
use Illuminate\Http\Request;
use App\Repositories\Admin\MainRepository;
use App\Repositories\Admin\FriendRepository;
use App\Repositories\Admin\MessageRepository;

class CrudController extends AdminBaseController
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

        /*if ($_GET['id'] == '1') {
            return "sssss";
        }*/
        //return "sssss";
        $countTasks = MainRepository::getCountTasks();
        $countActiveTasks = MainRepository::getCountActiveTasks();
        $countUnreadMessages = MainRepository::getCountUnreadMessages();
        $countNewFriends = MainRepository::getCountNewFriends();

        $perpage = 10;

        $last_messages = $this->messageRepository->getNewMessages($perpage);
        $last_friends = $this->friendRepository->getNewFriends($perpage);

/*        return view('bot.admin.main.index', compact(
            'countTasks',
            'countActiveTasks',
            'countUnreadMessages',
            'countNewFriends',
            'last_messages',
            'last_friends'
        ));*/
        return response()->json(compact(
            'last_messages',
            'last_friends'
        ));
        /*return response()->json(compact(

            'last_messages'
        ));*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ajax');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = "Error POST (store)";
        $result = $request->post('uid');
        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($f, $type, $s)
    {
        $perpage = 20;
        $result = "Error";
        switch ($type){
            case 'messages':
                $result = $this->messageRepository->getMessagesByUserLogin($f, $s, $perpage);
                break;
            case 'messagesid':
                $result = $this->messageRepository->getMessagesByUserId($f, $s, $perpage);
                break;
            case 'allmessages':
                $result = $this->messageRepository->getMessagesByOwnId($f, $s, 500);
                break;
            case 'allfriends':
                $result = $this->friendRepository->getFriendsByOwnId($f, $s, 500);
                break;
            case 'countbytask': //count of new incoming messages by task_id
                $owns = MainRepository::getOwnsByTask($s,'own_id');
//            dd($owns);
                $count = 0;
                $count_all = 0;
                $result = [];
                foreach ($owns as $own) {
                    $count += $this->messageRepository->getNewMessagesByOwnId($own->own_id);
                    $count_all += $this->messageRepository->getAllMessagesByOwnId($own->own_id);
                }
                $result['m'] = $count;
                $result['am'] = $count_all;
                $count = 0;
                $count_all = 0;
                foreach ($owns as $own) {
                    $count += $this->friendRepository->getNewFriendsByOwnId($own->own_id);
                    $count_all += $this->friendRepository->getAllFriendsByOwnId($own->own_id);
                }
                $result['f'] = $count;
                $result['af'] = $count_all;
                break;
        }
        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('ajax3');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $type)
    {
        $result = "Error";
        switch ($type){
            case 'hiderows':
                $own_id = $request->post('oid');
                $user_id = $request->post('uid');
                $result = $this->messageRepository->hideMessagesByIds($own_id, $user_id);
                $result = $this->friendRepository->hideFriendsByIds($own_id, $user_id);
                break;
            case 'message':
                $result = $this->messageRepository->hideMessageOverview($id);
                break;
            case 'friend':
                $result = $this->friendRepository->hideFriendOverview($id);
                break;
            case 'sendmessage':
                $own_id = $request->post('oid');
                $user_id = $request->post('uid');
                $message = $request->post('m');
                $result = $this->messageRepository->putMessage($own_id, $user_id, $message);
                break;
            case 'all':
                preg_match('/(\d+)\-(\d+)/', $id, $matches);
                dd($matches);
                if (!$matches[1] || !$matches[2])
                    return 'Error ID';
                $result = $this->messageRepository->hideMessageOverview($matches[1]);
                $result .= $this->friendRepository->hideFriendOverview($matches[2]);
                break;
        }
        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return view('ajax4');
    }
}
