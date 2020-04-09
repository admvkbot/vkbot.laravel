<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/31/2020
 * Time: 5:37 PM
 */

namespace App\Repositories\Admin;


use App\Repositories\CoreRepository;
use App\Models\Admin\Friend as Model;

class FriendRepository extends CoreRepository
{

    public function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass(){
        return Model::class;
    }

    public function getNewFriends($perpage) {

        $friends = $this->startConditions()::withTrashed()
            ->join('own_accounts', 'friends.own_id', '=', 'own_accounts.id')
            ->join('accounts', 'friends.user_id', '=', 'accounts.id')
            ->where('friends.done_at', '!=', '')
            ->select('friends.id', 'accounts.account_id', 'own_accounts.login', 'own_accounts.description')
            ->orderBy('friends.created_at')
            ->toBase()
            ->paginate($perpage);

        return $friends;
    }

    /** hideFriends from Overview */
    public function hideFriendOverview($id){
        $result = \DB::table('friends')
            ->where('id', $id)
            ->update(array('status' => 1));
        return $result;
    }

    //Show friends by own id
    public function getFriendsByOwnId($tmp, $own_id, $perpage){
        $friends = $this->startConditions()::withTrashed()
            ->where('friends.own_id', '=', $own_id)
            ->where('friends.done_at', '!=', "")
            ->where('friends.direction', '=', 0)
            ->select('friends.id', 'friends.own_id', 'friends.user_id', 'friends.status')
            ->orderBy('friends.created_at')
            ->toBase()
            ->paginate($perpage);

        return $friends;
    }

}