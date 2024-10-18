<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleTag extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
    ];

    // public function articles()
    // {
    //     return $this->belongsToMany(Article::class, 'article_tag_pivot');
    // }

    // public function getArticleCountAttribute()
    // {
    //     return $this->articles->count();
    // }
}
