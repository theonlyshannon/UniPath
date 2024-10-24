<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'mentor_id',
        'course_category_id',
        'title',
        'slug',
        'description',
        'thumbnail',
        'level',
        'meetings',
        'trailer',
        'is_favourite',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_favourite' => 'boolean',
    ];

    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }

    public function courseCategory()
    {
        return $this->belongsTo(CourseCategory::class);
    }

    public function syllabus()
    {
        return $this->hasMany(CourseSyllabus::class);
    }

    public function courseSubject()
    {
        return $this->hasMany(CourseSubject::class);
    }
}
