<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyOtp extends Model
{
     protected $table = 'company_otps';
    protected $fillable = [
        'email',
        'otp',
        'is_used',
        'expires_at'
    ];
}
