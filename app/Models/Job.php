<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'job';
    protected $fillable = [
        'id',
        'title',
        'text',
        'user_id',


    ];

}
