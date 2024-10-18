<?php

namespace App\Repositories;

use App\Interfaces\ArticleTagRepositoryInterface;
use App\Models\ArticleTag;

class ArticleTagRepository implements ArticleTagRepositoryInterface
{
    public function getAllArticleTag()
    {
        return ArticleTag::all();
    }

    public function getArticleTagById(string $id)
    {
        return ArticleTag::findOrFail($id);
    }

    public function createArticleTag(array $data)
    {
        return ArticleTag::create($data);
    }

    public function updateArticleTag(array $data, string $id)
    {
        $articleTag = $this->getArticleTagById($id);

        $articleTag->update($data);

        return $articleTag;
    }

    public function deleteArticleTag(string $id)
    {
        $articleTag = $this->getArticleTagById($id);

        $articleTag->delete();

        return $articleTag;
    }
}
