<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Savejob extends Model
{
    //

     protected $fillable = ['user_id','job_id'];

    public function job()
    {
        return $this->belongsTo(Postjob::class,'job_id');
    }
}
