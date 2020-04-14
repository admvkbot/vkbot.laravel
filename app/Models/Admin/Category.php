<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'title',
        'type',
    ];

    protected $table = 'categories';

    public function getQualifiedDeletedAtColumn()
    {
        return 'created_at';
    }
}
