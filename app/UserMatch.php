<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMatch extends Model
{

    protected $table = 'user_matches';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'match_id', 'score1', 'score2'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function match() {
        return $this->belongsTo(Match::class);
    }
}
