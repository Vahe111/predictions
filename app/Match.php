<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{

    protected $table = 'matches';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'score1', 'score2'
    ];

    public function userMatch()
    {
        return $this->hasMany(UserMatch::class);
    }
}
