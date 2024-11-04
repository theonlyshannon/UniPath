<?php

namespace App\Repositories;

use App\Interfaces\ArticleCommentRepositoryInterface;
use App\Models\ArticleComment;

class ArticleCommentRepository implements ArticleCommentRepositoryInterface
{
    public function getAllArticleComments(?int $perPage = null, ?string $search = null)
    {
        return ArticleComment::all();
    }

    public function getArticleCommentByArticleId(string $articleId)
    {
        return ArticleComment::where('article_id', $articleId)->get();
    }

    public function getArticleCommentById(string $id)
    {
        return ArticleComment::findOrFail($id);
    }

    public function createArticleComment(array $data)
    {
        return ArticleComment::create($data);
    }

    public function updateArticleComment(array $data, string $id)
    {
        $comment = ArticleComment::findOrFail($id);
        $comment->update($data);
        return $comment;
    }

    public function deleteArticleComment(string $id)
    {
        $comment = ArticleComment::findOrFail($id);
        $comment->delete();
        return $comment;
    }
}
