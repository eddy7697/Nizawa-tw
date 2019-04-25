<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $table = 'careers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'location',
        'experience',
        'education',
        'description',
        'paymentRange',
        'number',
        'department',
        'status',
        'isTop',
        'isShow'
    ];
}
