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
            ->join('accounts', 'messages.user_id', '=', 'accounts.id')
            ->where('messages.status', 3)
            ->where('messages.overview_status', 1)
            ->latest('messages.created_at')
            ->select('messages.id', 'messages.message', 'accounts.account_id', 'own_accounts.login', 'own_accounts.description')
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

//Show messages by user login
    public function getMessagesByUserLogin($user_login, $own_login, $perpage){
        $user_id = \DB::table('accounts')
            ->where('account_id', $user_login)
            ->get('id');

        $own_id = \DB::table('own_accounts')
            ->where('login', $own_login)
            ->get('id');

        $messages = $this->startConditions()::withTrashed()
            ->where('messages.user_id', '=', $user_id[0]->id)
            ->where('messages.own_id', '=', $own_id[0]->id)
            ->select('messages.id', 'messages.message', 'messages.direction', 'messages.status', 'messages.created_at')
            ->orderBy('messages.created_at')
            ->toBase()
            ->paginate($perpage);

        $unreadMessages = \DB::table('messages')
            ->where('user_id', $user_id[0]->id)
            ->where('own_id', $own_id[0]->id)
            ->get('id');

        foreach ($unreadMessages as $value) {
            $this->hideMessageOverview($value->id);
        }

        return $messages;
    }

//Show messages by own id
    public function getMessagesByOwnId($tmp, $own_id, $perpage){
        $messages = $this->startConditions()::withTrashed()
            ->where('messages.own_id', '=', $own_id)
            ->where('messages.overview_status', '=', 1)
            ->select('messages.id', 'messages.own_id', 'messages.user_id', 'messages.message', 'messages.direction', 'messages.status', 'messages.created_at')
            ->orderBy('messages.created_at')
            ->toBase()
            ->paginate($perpage);

/*        $unreadMessages = \DB::table('messages')
            ->where('user_id', $user_id[0]->id)
            ->where('own_id', $own_id[0]->id)
            ->get('id');

        foreach ($unreadMessages as $value) {
            $this->hideMessageOverview($value->id);
        }*/

        return $messages;
    }

}

