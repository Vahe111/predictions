<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserChampion extends Model
{

    protected $table = 'user_champion';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'team'
    ];
}
