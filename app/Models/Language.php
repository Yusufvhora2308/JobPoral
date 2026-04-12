<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    //
       protected $table = 'languages';
      protected $fillable = ['user_id','language','level'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
