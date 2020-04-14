<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Illuminate\Database\Query\Builder;

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
        'overview_status',
        'created_at',
        'updated_at',
    ];

    protected $table = 'messages';

    public function getQualifiedDeletedAtColumn()
    {
        return 'created_at';
    }
}
