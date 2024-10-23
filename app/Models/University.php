<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class University extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'location',
        'description',
    ];

    function faculties()
    {
        return $this->hasMany(Faculty::class);
    }

    function Interests()
    {
        return $this->hasMany(UniversityInterest::class);
    }
}
