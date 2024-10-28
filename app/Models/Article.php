<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory, UUID, SoftDeletes;

    protected $fillable = [
        'thumbnail',
        'title',
        'content',
        'slug',
        'writer_id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function writer()
    {
        return $this->belongsTo(Writer::class);
    }

    public function categories()
    {
        return $this->belongsToMany(ArticleCategory::class, 'article_category_pivot');
    }

    public function tags()
    {
        return $this->belongsToMany(ArticleTag::class, 'article_tag_pivot');
    }

    public function getThumbnailAttribute($value)
    {
        return asset('storage/' . $value);
    }

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->diffForHumans();
    }

    public function getExcerptAttribute()
    {
        return substr(strip_tags($this->content), 0, 100) . '...';
    }

}
