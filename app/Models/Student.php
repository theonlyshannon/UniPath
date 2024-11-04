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
        'last_active_at',
        'asal_sekolah',
        'university_main_id',
        'university_second_id',
        'faculty_main_id',
        'faculty_second_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mainUniversity()
    {
        return $this->belongsTo(University::class, 'university_main_id');
    }

    public function secondUniversity()
    {
        return $this->belongsTo(University::class, 'university_second_id');
    }

    public function mainFaculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_main_id');
    }

    public function secondFaculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_second_id');
    }
}
