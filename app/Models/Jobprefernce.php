<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobprefernce extends Model
{
    //
    protected $fillable = [
    'user_id',
    'job_title',
    'job_type',
    'work_schedule',
    'remote',
    'pay',
    'relocation'
];
}
