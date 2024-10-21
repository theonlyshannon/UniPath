<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UUID;

class FacultyInterest extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'faculty_id',
        'interest',
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }
}
