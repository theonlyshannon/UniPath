<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UUID;

class UniversityInterest extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'university_id',
        'interest',
    ];

    public function university()
    {
        return $this->belongsTo(University::class);
    }
}
