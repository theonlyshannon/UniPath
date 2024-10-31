<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseReview extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        'course_id',
        'student_id',
        'review',
        'is_approved',
        'rating'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function getDateFormattedAttribute()
    {
        return Carbon::parse($this->created_at)->translatedFormat('d F Y');
    }

    public function getStarRatingAttribute()
    {
        $stars = str_repeat('★', $this->rating);
        $emptyStars = str_repeat('☆', 5 - $this->rating);
        return $stars . $emptyStars;
    }
}
