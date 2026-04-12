<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
         protected $table = 'pays';
      protected $fillable = ['user_id','amount','period'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
