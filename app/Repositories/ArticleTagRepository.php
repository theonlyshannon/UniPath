<?php

namespace App\Repositories;

use App\Interfaces\ArticleTagRepositoryInterface;
use App\Models\ArticleTag;

class ArticleTagRepository implements ArticleTagRepositoryInterface
{
    /**
     * Retrieve all article tags.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllArticleTag()
    {
        return ArticleTag::all();
    }

    /**
     * Retrieve a specific article tag by its ID.
     *
     * @param string $id The ID of the article tag.
     * @return ArticleTag
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getArticleTagById(string $id)
    {
        return ArticleTag::findOrFail($id);
    }

    /**
     * Retrieve the count of articles associated with each tag.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getArticleCountByTag()
    {
        return ArticleTag::withCount('articles')
            ->orderBy('articles_count', 'DESC')
            ->get(['name', 'articles_count']);
    }

    /**
     * Create a new article tag.
     *
     * @param array $data The data for the new article tag.
     * @return ArticleTag
     */
    public function createArticleTag(array $data)
    {
        return ArticleTag::create($data);
    }

    /**
     * Update an existing article tag.
     *
     * @param array $data The new data for the article tag.
     * @param string $id The ID of the article tag to update.
     * @return ArticleTag
     */
    public function updateArticleTag(array $data, string $id)
    {
        $articleTag = $this->getArticleTagById($id);

        $articleTag->update($data);

        return $articleTag;
    }

    /**
     * Delete an article tag by its ID.
     *
     * @param string $id The ID of the article tag to delete.
     * @return ArticleTag
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function deleteArticleTag(string $id)
    {
        $articleTag = $this->getArticleTagById($id);

        $articleTag->delete();

        return $articleTag;
    }
}
