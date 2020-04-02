<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'own_id',
        'user_id',
        'direction',
        'message',
        'status',
        'created_at',
        'updated_at',
    ];
}
