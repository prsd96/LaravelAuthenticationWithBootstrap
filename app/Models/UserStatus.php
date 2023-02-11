<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    protected $fillable = [
        'name',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'status_id', 'id');
    }
}
