<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workschedule extends Model
{
    //
       protected $table = 'workschedules';
      protected $fillable = ['user_id','schedule'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
