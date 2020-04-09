<?php

namespace App\Http\Controllers\Bot\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\MessageRepository;
use App\Repositories\Admin\MainRepository;
use App\Repositories\Admin\FriendRepository;
use Illuminate\Http\Request;

class CommController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $ommRepository;

    public function __construct()
    {
        parent::__construct();
        //$this->commRepository = app(MessageRepository::class);
        $this->messageRepository = app(MessageRepository::class);
        $this->friendRepository = app(FriendRepository::class);
    }

    public function index()
    {
        $perpage = 10;

        $tasks = MainRepository::getTasks();
        foreach ($tasks as $value) {
            $value->owns = null;
            $own_ids = MainRepository::getOwnsByTask($value->id);
            //dd($own_ids);
            $own = null;
            $owns_arr=[];
            foreach ($own_ids as $val) {
                $owns = MainRepository::getOwnById($val->own_id);;
                foreach ($owns as $v) {
                    $val->login = $v->login;
                    $val->description = $v->description;
                }
                $owns_arr[$val->own_id] = $val;
            }
            $value->data = $owns_arr;
        }
        //dd($tasks);
        return view('bot.admin.communication.index', compact(
            'tasks'
        ));
/*        'countUnreadMessages',
            'ownMessageUsers',
            'ownMessages',
            'ownFriends'*/
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
