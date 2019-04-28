<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Qna extends Model
{
    protected $table = 'qnas';

    protected $fillable = [
        'isTop',
        'qatitle',
        'qatype',
        'qacontent',
    ];
}
