<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postjob extends Model
{
    //

    // Allow mass assignment for these fields
    protected $fillable = [
        'company_id',       // <- Important for mass assignment
        'job_title',
        'job_type',
        'location',
        'experience_level',
        'salary',
         'logo',  
        'education',
        'job_description',
        'requirements',
        'skills',
      'start_date',
        'last_date',
        'status',
    ];

    protected $casts = [
    'start_date' => 'datetime',
    'last_date' => 'datetime',
];

    // Optional: relationship with Company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    
      public function applicants()
    {
        return $this->hasMany(Jobapplicant::class, 'job_id');
    }

public function scopeActive($query)
{
    return $query->where('status', 1)
        ->where(function ($q) {
            $q->whereNull('start_date')
              ->orWhere('start_date', '<=', now()); // ✅ FIX
        })
        ->where('last_date', '>=', now()); // ✅ FIX
}
}
