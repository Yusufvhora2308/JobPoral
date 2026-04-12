<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobNotification extends Model
{
    //
      protected $fillable = ['user_id','job_id','is_read'];

    public function job()
    {
        return $this->belongsTo(Postjob::class,'job_id');
    }
}
