<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'photo',
        'gender'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function users() {
        return $this->belongsTo(Role::class);
    }


    public function getPhotoUrlAttribute() {
        $path = public_path('photos/' . $this->photo);

        $defaultImage = asset('photos/profile_photo.png'); 
        return file_exists($path) ? asset('storage/' . $this->photo) : $defaultImage;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }
   
    public function orders() {
        return $this->hasMany(Food::class);
    }
    public function getRoles()
    {
        return $this->roles ?? []; 
    }
    public function hasRole($roleName)
    {
        return $this->roles->contains('name', $roleName);
    }
    public function hasAnyRole($roles): bool
    {
        $roles = is_array($roles) ? $roles : [$roles];
        return $this->roles->pluck('name')->intersect($roles)->isNotEmpty();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
