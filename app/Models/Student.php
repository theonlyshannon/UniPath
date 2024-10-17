<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UUID;

class Student extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'user_id',
        'username',
        'name',
        'gender',
        'occupation_type',
        'occupation',
        'phone',
        'city',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
