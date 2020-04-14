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

    //Show count of new incoming friends
    public function getNewFriendsByOwnId($own_id){
        $count = \App\Models\Admin\Friend::withTrashed()
            ->where('direction', 0)
            ->where('own_id', $own_id)
            ->where('status', 0)
            ->count();
        return $count;
    }

    //Show count of all incoming friends
    public function getAllFriendsByOwnId($own_id){
        $count = \App\Models\Admin\Friend::withTrashed()
            ->where('direction', 0)
            ->where('own_id', $own_id)
            ->count();
        return $count;
    }

    /** hideFriends from Overview */
    public function hideFriendOverview($id){
        $result = \DB::table('friends')
            ->where('id', $id)
            ->update(array('status' => 1));
        return $result;
    }

    /** hide messages use oun_id and user_id */
    public function hideFriendsByIds($own_id, $user_id) {
        \App\Models\Admin\Friend::withTrashed()
            ->where('own_id', $own_id)
            ->where('user_id', $user_id)
            ->update(['status' => 1]);
    }
    //Show friends by own id
    public function getFriendsByOwnId($tmp, $own_id, $perpage){
        $friends = $this->startConditions()::withTrashed()
            ->where('friends.own_id', '=', $own_id)
            ->where('friends.done_at', '!=', "")
            ->where('friends.direction', '=', 0)
            ->join('accounts', 'accounts.id', '=', 'friends.user_id')
            ->join('own_accounts', 'own_accounts.id', '=', 'friends.own_id')
            ->latest()
            ->select('friends.id', 'friends.own_id', 'friends.user_id', 'friends.status', 'friends.created_at','accounts.account_id', 'accounts.description', 'own_accounts.login')
            ->orderBy('friends.created_at')
            ->toBase()
            ->paginate($perpage);

        return $friends;
    }

}