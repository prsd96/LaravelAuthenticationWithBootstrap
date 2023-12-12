<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    use HasFactory;

    protected $fillable = [
        'email', 'token',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::created(function ($query) {
            $query->expires_at = Helper::calculateExpiry($query->created_at, '10', 'minutes');
        });
    }
}
