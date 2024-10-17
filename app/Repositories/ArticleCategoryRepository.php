<?php

namespace App\Repositories;

use App\Interfaces\ArticleCategoryRepositoryInterface;
use App\Models\ArticleCategory;

class ArticleCategoryRepository implements ArticleCategoryRepositoryInterface
{
    public function getAllArticleCategory()
    {
        return ArticleCategory::all();
    }

    public function getArticleCategoryById(string $id)
    {
        return ArticleCategory::findOrFail($id);
    }

    public function createArticleCategory(array $data)
    {
        return ArticleCategory::create($data);
    }

    public function updateArticleCategory(array $data, string $id)
    {
        $articleCategory = $this->getArticleCategoryById($id);

        $articleCategory->update($data);

        return $articleCategory;
    }

    public function deleteArticleCategory(string $id)
    {
        $articleCategory = $this->getArticleCategoryById($id);

        $articleCategory->delete();

        return $articleCategory;
    }
}
