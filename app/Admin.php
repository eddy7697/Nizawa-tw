<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'guid',
        'name',
        'email',
        'password',
        'jobTitle',
        'role',
        'level',
        'status',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];
}
