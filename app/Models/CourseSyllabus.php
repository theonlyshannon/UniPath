<?php

namespace App\Models;

use App\Traits\UUID;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseSyllabus extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $table = 'course_syllabus';

    protected $fillable = [
        'course_id',
        'sort',
        'title',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
