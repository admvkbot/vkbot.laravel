<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Friend extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'own_id',
        'user_id',
        'status',
        'direction',
        'created_at',
        'done_at',
    ];

    protected $table = 'friends';

    public function getQualifiedDeletedAtColumn()
    {
        return 'created_at';
    }
}
