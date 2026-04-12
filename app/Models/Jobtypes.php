<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobtypes extends Model
{
    //
    protected $table = 'jobtypes';
      protected $fillable = ['user_id','type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
