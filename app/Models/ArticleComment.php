<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleComment extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'article_id',
        'name',
        'email',
        'comment',
        'is_approved',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
