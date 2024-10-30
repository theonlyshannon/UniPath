<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleVisitor extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        'visitor_ip',
        'article_id'
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
