<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseSubject extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'subject_file',
        'subject_video',
    ];
}
