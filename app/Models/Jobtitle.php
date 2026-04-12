<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobtitle extends Model
{
    //

    protected $table = 'jobtitles';
      protected $fillable = ['user_id','title'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
