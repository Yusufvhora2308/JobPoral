<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
    'name','email','phone','location','password',
    'qualification','skills','experience',
    'job_role','resume',
    'profile_photo','cover_photo','ready_to_work','role',    'address'
];

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function educations()
{
    return $this->hasMany(Education::class);
}

public function skills()
{
    return $this->hasMany(Skill::class);
}

public function languages()
{
    return $this->hasMany(Language::class);
}
public function certificates()
{
    return $this->hasMany(Certificate::class);
}
public function licenses()
{
    return $this->hasMany(License::class);
}

public function jobtitles()
{
    return $this->hasMany(Jobtitle::class);
}

public function jobtypes()
{
    return $this->hasMany(Jobtypes::class);
}

public function remotes()
{
    return $this->hasMany(Remote::class);
}

public function workschedules()
{
    return $this->hasMany(Workschedule::class);
}

public function pays()
{
    return $this->hasMany(Pay::class);
}


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
