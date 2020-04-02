<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/27/2020
 * Time: 8:30 PM
 */

namespace App\Repositories\Admin;


use App\Repositories\CoreRepository;
use Illuminate\Database\Eloquent\Model;

class MainRepository extends CoreRepository
{

    protected function getModelClass()
    {
        return Model::class;
    }

    /** Get counts all tasks */
    public static function getCountTasks(){
        $count = \DB::table('tasks')
            ->get()
            ->count();
        return $count;
    }

    /** Get counts active tasks */
    public static function getCountActiveTasks(){
        $count = \DB::table('tasks')
            ->where('status', '1')
            ->get()
            ->count();
        return $count;
    }

    /** Get counts unread messages */
    public static function getCountUnreadMessages(){
        $count = \DB::table('messages')
            ->where('status', 3)
            ->get()
            ->count();
        return $count;
    }

    /** Get counts new friends */
    public static function getCountNewFriends(){
        $count = \DB::table('friends')
            ->where('status', 0)
            ->get()
            ->count();
        return $count;
    }


}