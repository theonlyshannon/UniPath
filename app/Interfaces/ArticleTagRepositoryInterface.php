<?php

namespace App\Interfaces;

interface ArticleTagRepositoryInterface
{
    public function getAllArticleTag();

    public function getArticleTagById(string $id);

    public function getArticleCountByTag();

    public function createArticleTag(array $data);

    public function updateArticleTag(array $data, string $id);

    public function deleteArticleTag(string $id);
}
