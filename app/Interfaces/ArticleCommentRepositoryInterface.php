<?php

namespace App\Interfaces;

interface ArticleCommentRepositoryInterface
{
    public function getAllArticleComments(?int $perPage = null, ?string $search = null);

    public function getArticleCommentByArticleId(string $articleId);

    public function getArticleCommentById(string $id);

    public function createArticleComment(array $data);

    public function updateArticleComment(array $data, string $id);

    public function deleteArticleComment(string $id);
}
