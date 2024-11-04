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

    public function updateStatusIsActive($articleCommentId, $isActive)
    {
        $course = ArticleComment::findOrFail($articleCommentId);

        $course->is_active = $isActive;

        $course->save();
    }

    public function deleteArticleComment(string $id)
    {
        $comment = ArticleComment::findOrFail($id);
        $comment->delete();
        return $comment;
    }
}
