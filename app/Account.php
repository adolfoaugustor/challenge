<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'social_reason',
        'fantasy_name',
        'agency',
        'number',
        'digit',
        'type_account',
    ];

    public function user()
    {
        return $this->hasOne('App\User');
    }
}