<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/31/2020
 * Time: 5:37 PM
 */

namespace App\Repositories\Admin;


use App\Repositories\CoreRepository;
use App\Models\Admin\Message as Model;

class MessageRepository extends CoreRepository
{

    public function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass(){
        return Model::class;
    }

//lesson 7-1 15:17
    public function getNewMessages($perpage){
        $messages = $this->startConditions()::withTrashed()
            ->join('own_accounts', 'messages.own_id', '=', 'own_accounts.id')
            ->where('messages.status', 3)
            ->where('messages.overview_status', 1)
            ->select('messages.id', 'messages.message', 'own_accounts.login', 'own_accounts.description')
            ->orderBy('messages.created_at')
            ->toBase()
            ->paginate($perpage);

        return $messages;
    }

    /** hideMessage from Overview */
    public function hideMessageOverview($id){
        $result = \DB::table('messages')
            ->where('id', $id)
            ->update(array('overview_status' => 0));
        return $result;
    }

}

