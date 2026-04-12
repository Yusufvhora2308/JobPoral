<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobapplicant extends Model
{
    //
  protected $fillable = [
    'job_id',
    'user_id',
    'name',
    'email',
    'contact',
    'resume',
    'video_resume',
    'match_score',
    'missing_skills',
    'status',
];

    public function job()
    {
        return $this->belongsTo(Postjob::class, 'job_id');
    }

   

}
