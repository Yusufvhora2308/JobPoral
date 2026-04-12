<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Remote extends Model
{
       protected $table = 'remotes';
      protected $fillable = ['user_id','type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
