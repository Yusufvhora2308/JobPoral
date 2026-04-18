<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Companyreview extends Model
{
      protected $fillable = [
        'company_id','user_id',
        'rating','work_culture','salary','growth','review'
    ];

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
