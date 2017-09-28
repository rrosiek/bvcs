<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'email',
        'last_name',
        'first_name',
        'address',
        'subscribed',
    ];
}
