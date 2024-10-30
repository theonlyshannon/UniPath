<?php

namespace App\Interfaces;

interface ArticleRepositoryInterface
{
    public function getAllArticle(?int $perPage = null, ?string $category = null, ?string $tag = null);

    public function getArticleById(string $id);

    public function getArticleBySlug(string $slug);

    public function getArticleByCategory(string $category);

    public function getArticlesCountByDate();

    public function getArticleByTag(string $tag);

    public function createArticle(array $data);

    public function updateArticle(array $data, string $id);

    public function deleteArticle(string $id);
}
