<?php

namespace App\Repositories;

use App\Interfaces\ArticleCategoryRepositoryInterface;
use App\Models\ArticleCategory;

class ArticleCategoryRepository implements ArticleCategoryRepositoryInterface
{
    /**
     * Retrieve all article categories.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllArticleCategory()
    {
        return ArticleCategory::all();
    }

    /**
     * Retrieve an article category by its ID.
     *
     * @param string $id
     * @return ArticleCategory
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getArticleCategoryById(string $id)
    {
        return ArticleCategory::findOrFail($id);
    }

    /**
     * Create a new article category.
     *
     * @param array $data
     * @return ArticleCategory
     */
    public function createArticleCategory(array $data)
    {
        return ArticleCategory::create($data);
    }

    /**
     * Update an existing article category.
     *
     * @param array $data
     * @param string $id
     * @return ArticleCategory
     */
    public function updateArticleCategory(array $data, string $id)
    {
        $articleCategory = $this->getArticleCategoryById($id);

        $articleCategory->update($data);

        return $articleCategory;
    }

    /**
     * Delete an article category by its ID.
     *
     * @param string $id
     * @return ArticleCategory
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function deleteArticleCategory(string $id)
    {
        $articleCategory = $this->getArticleCategoryById($id);

        $articleCategory->delete();

        return $articleCategory;
    }
}
