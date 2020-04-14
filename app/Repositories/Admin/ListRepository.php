<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 4/13/2020
 * Time: 5:12 PM
 */

namespace App\Repositories\Admin;

use App\Repositories\CoreRepository;
use App\Models\Admin\Category as Model;


class ListRepository extends CoreRepository
{

    public function __construct()
    {
        parent::__construct();
    }

    protected function getModelClass(){
        return Model::class;
    }

    public static function getCountCategories() {
        $count = \DB::table('categories')
            ->get()
            ->count();
        return $count;
    }

    public function getAllCategories($perpage){
        $categories = $this->startConditions()::withTrashed()
            ->select('categories.id', 'categories.title', 'categories.description')
            ->orderBy('categories.title')
            ->toBase()
            ->paginate($perpage);

        return $categories;
    }

    public function getCategoryById($id){
        $categories = \DB::table('categories')
            ->where('id', $id)
            ->get();

        return $categories;
    }

    public function getOneOrder($id) {
        $category = $this->startConditions()::withTrashed()
            ->select('categories.*')
            ->where('categories.id', $id)
            ->orderBy('categories.title')
            ->limit(1)
            ->first();

        return $category;
    }
}