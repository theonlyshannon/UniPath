<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mentor extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'user_id',
        'username',
        'name',
        'profile_picture',
        'gender',
        'phone',
        'city',
        'degree',
        'bio',
    ];

    public function getProfilePictureAttribute($value)
    {
        return url('storage/' . $value);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
