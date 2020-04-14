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

use DigitalStar\vk_api\Message;

use Illuminate\Support\Facades\Schema;

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
    /** hide messages use oun_id and user_id */
    public function hideMessagesByIds($own_id, $user_id) {
/*        Schema::table('friends', function ($table) {
    $table->timestamp('updated_at')->nullable();
});*/

        \App\Models\Admin\Message::withTrashed()
            ->where('own_id', $own_id)
            ->where('user_id', $user_id)
            ->update(['overview_status' => 0]);
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

/*        $unreadMessages = \DB::table('messages')
            ->where('user_id', $user_id[0]->id)
            ->where('own_id', $own_id[0]->id)
            ->get('id');

        foreach ($unreadMessages as $value) {
            $this->hideMessageOverview($value->id);
        }*/

        return $messages;
    }

    //Show messages by user ID
    public function getMessagesByUserId($user_ID, $own_ID, $perpage){
        $messages = $this->startConditions()::withTrashed()
            ->where('messages.user_id', '=', $user_ID)
            ->where('messages.own_id', '=', $own_ID)
            ->select('messages.id', 'messages.message', 'messages.direction', 'messages.status', 'messages.created_at')
            ->orderBy('messages.created_at', 'desc')
            ->toBase()
            ->paginate($perpage);

        return $messages;
    }

    //Show count new incoming messages
    public function getNewMessagesByOwnId($own_id){
        $count = \App\Models\Admin\Message::withTrashed()
            ->where('direction', 0)
            ->where('own_id', $own_id)
            ->where('overview_status', 1)
            ->count();
        return $count;
    }

    //Show count all incoming messages
    public function getAllMessagesByOwnId($own_id){
        $count = \App\Models\Admin\Message::withTrashed()
            ->where('direction', 0)
            ->where('own_id', $own_id)
            ->count();
        return $count;
    }

//Show messages by own id
    public function getMessagesByOwnId($tmp, $own_id, $perpage){
        /*Schema::table('accounts', function ($table) {
            $table->timestamp('updated_at')->nullable();
        });*/
        $messages = $this->startConditions()::withTrashed()
            ->where('messages.own_id', '=', $own_id)
            ->where('messages.overview_status', '=', 1)
            ->where('messages.direction', '=', 0)
            ->join('accounts', 'accounts.id', '=', 'messages.user_id')
            ->join('own_accounts', 'own_accounts.id', '=', 'messages.own_id')
            ->latest()
            ->select('messages.id', 'messages.own_id', 'messages.user_id', 'messages.message', 'messages.direction', 'messages.status', 'messages.created_at', 'accounts.account_id', 'accounts.description', 'own_accounts.login')
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

//Store message
    public function putMessage($own_id, $user_id, $message){
        \App\Models\Admin\Message::create([
                'own_id' => $own_id,
                'user_id' => $user_id,
                'direction' => 1,
                'message' => $message,
                'status' => 1,
                'overview_status' => 0,
        ]);

        return 1;
    }
}

