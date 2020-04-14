<?php

namespace App\Http\Controllers\Bot\Admin\Lists;

use App\Http\Controllers\Bot\Admin\AdminBaseController;
use App\Http\Controllers\Controller;
use App\Repositories\Admin\MessageRepository;
use App\Repositories\Admin\MainRepository;
use App\Repositories\Admin\FriendRepository;
use Illuminate\Http\Request;
use App\Repositories\Admin\ListRepository;

class CategoriesController extends AdminBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $commRepository;

    public function __construct()
    {
        parent::__construct();
        //$this->commRepository = app(MessageRepository::class);
        $this->messageRepository = app(MessageRepository::class);
        $this->friendRepository = app(FriendRepository::class);
        $this->listRepository = app(ListRepository::class);
    }

    public function index()
    {
        $perpage = 12;
        $countRows = ListRepository::getCountCategories();
        $paginator = $this->listRepository->getAllCategories($perpage);

        return view('bot.admin.lists.categories', compact(
                    'countRows', 'paginator'
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
//        $item = $this->listRepository->getCategoryById($id);
        $item = $this->listRepository->getId($id);
        if (empty($item)){
            abort(404);
        }
        $category = $this->listRepository->getOneOrder($item->id);
        if (!$category){
            abort(404);
        }
        return response()->json($category);
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
