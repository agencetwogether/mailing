<?php

namespace Agencetwogether\Mailing\Models;

use Illuminate\Database\Eloquent\Model;

class PendingSubscriber extends Model
{
    protected $fillable = [
        'email',
        'data',
        'options',
        'token',
        'confirmed_at',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array',
            'options' => 'array',
            'confirmed_at' => 'datetime',
        ];
    }
}
