<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\UUID;

class ChatLogs extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'user_id',
        'sender',
        'message',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
