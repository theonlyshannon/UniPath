<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UUID;

class Roles extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        // Add your columns here
    ];
}
