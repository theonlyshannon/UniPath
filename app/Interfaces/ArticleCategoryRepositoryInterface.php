<?php

namespace App\Interfaces;

interface ArticleCategoryRepositoryInterface
{
    public function getAllArticleCategory();

    public function getArticleCategoryById(string $id);

    public function createArticleCategory(array $data);

    public function updateArticleCategory(array $data, string $id);

    public function deleteArticleCategory(string $id);
}
