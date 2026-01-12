<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'user_id',
        'type',
        'category',
        'amount',
        'date',
        'description',
    ];

    protected $casts = [
        'date'   => 'datetime',
        'amount' => 'integer',
    ];
}
