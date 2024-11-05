<?php

namespace App\Repositories;

use App\Interfaces\ArticleCommentRepositoryInterface;
use App\Models\ArticleComment;

class ArticleCommentRepository implements ArticleCommentRepositoryInterface
{
    /**
     * Retrieve all article comments.
     *
     * @param int|null $perPage The number of comments per page.
     * @param string|null $search The search term to filter comments.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllArticleComments(?int $perPage = null, ?string $search = null)
    {
        return ArticleComment::all();
    }

    /**
     * Retrieve comments by article ID.
     *
     * @param string $articleId The ID of the article.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getArticleCommentByArticleId(string $articleId)
    {
        return ArticleComment::where('article_id', $articleId)->get();
    }

    /**
     * Retrieve a specific article comment by its ID.
     *
     * @param string $id The ID of the comment.
     * @return ArticleComment
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getArticleCommentById(string $id)
    {
        return ArticleComment::findOrFail($id);
    }

    /**
     * Create a new article comment.
     *
     * @param array $data The data for the new comment.
     * @return ArticleComment
     */
    public function createArticleComment(array $data)
    {
        return ArticleComment::create($data);
    }

    /**
     * Update the active status of an article comment.
     *
     * @param string $articleCommentId The ID of the comment.
     * @param bool $isActive The new active status.
     * @return void
     */
    public function updateStatusIsActive($articleCommentId, $isActive)
    {
        $course = ArticleComment::findOrFail($articleCommentId);

        $course->is_active = $isActive;

        $course->save();
    }

    /**
     * Delete an article comment by its ID.
     *
     * @param string $id The ID of the comment.
     * @return ArticleComment
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function deleteArticleComment(string $id)
    {
        $comment = ArticleComment::findOrFail($id);
        $comment->delete();
        return $comment;
    }
}
