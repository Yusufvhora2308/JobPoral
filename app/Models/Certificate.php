<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    //
        protected $table = 'certificates';
      protected $fillable = ['user_id','name','organization','year'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
