<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Writer extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'user_id',
        'username',
        'name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
