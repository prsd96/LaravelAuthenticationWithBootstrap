<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'status_id', 'role_id', 'first_name', 'last_name', 'email', 'password', 'mobile',
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
        'mobile_verified' => 'boolean',
        'mobile_verified_at' => 'datetime',
        'email_verified' => 'boolean',
        'email_verified_at' => 'datetime',
    ];
    
    /**
    * The "booting" method of the model.
    *
    * @return void
    */
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($query) {
            $query->password = bcrypt(request()->password);
            $query->status_id = $query->status_id ?? 1;
            $query->role_id = $query->role_id ?? 2;
            $query->email_verified = false;
            $query->mobile_verified = false;
        });
    }
    
    public function userStatus(): BelongsTo
    {
        return $this->belongsTo(UserStatus::class, 'status_id');
    }
    
    public function userRole(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function userEmailVerification(): HasOne
    {
        return $this->hasOne(UserEmailVerification::class, 'user_id');
    }
}
