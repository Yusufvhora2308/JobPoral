<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Authenticatable
{
    use HasFactory;

    protected $table = 'companies';

   protected $fillable = [
    'company_name',
    'email',
    'password',
    'logo',
    'cover',
    'description',
    'website',
    'location',
    'industry',
    'company_size',
    'founded_year',
];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function reviews()
{
    return $this->hasMany(CompanyReview::class);
}
}
