<?php

namespace App\Repositories;

use App\Models\Article;
use Illuminate\Support\Facades\DB;
use App\Interfaces\ArticleRepositoryInterface;

class ArticleRepository implements ArticleRepositoryInterface
{
    /**
     * Retrieve all articles with optional pagination, category, and tag filters.
     *
     * @param int|null $perPage The number of articles per page.
     * @param string|null $category The category slug to filter articles.
     * @param string|null $tag The tag slug to filter articles.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection
     */
    public function getAllArticle(?int $perPage = null, ?string $category = null, ?string $tag = null)
    {
        $articles = Article::query();

        if ($category) {
            $articles->whereHas('categories', function ($query) use ($category) {
                $query->where('slug', $category);
            });
        }

        if ($tag) {
            $articles->whereHas('tags', function ($query) use ($tag) {
                $query->where('slug', $tag);
            });
        }

        if ($perPage) {
            return $articles->latest()->paginate($perPage);
        }

        return $articles->latest()->get();
    }

    /**
     * Retrieve a specific article by its ID.
     *
     * @param string $id The ID of the article.
     * @return Article
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getArticleById(string $id)
    {
        return Article::findOrFail($id);
    }

    /**
     * Retrieve a specific article by its slug.
     *
     * @param string $slug The slug of the article.
     * @return Article
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getArticleBySlug(string $slug)
    {
        return Article::where('slug', $slug)->firstOrFail();
    }

    /**
     * Retrieve articles by category.
     *
     * @param string $category The category to filter articles.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getArticleByCategory(string $category)
    {
        return Article::where('category', $category)->get();
    }

    /**
     * Retrieve the count of articles grouped by date.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getArticlesCountByDate()
    {
        return DB::table('articles')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();
    }

    /**
     * Retrieve articles by tag.
     *
     * @param string $tag The tag to filter articles.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getArticleByTag(string $tag)
    {
        return Article::where('tag', $tag)->get();
    }

    /**
     * Create a new article with associated tags and categories.
     *
     * @param array $data The data for the new article.
     * @return Article
     */
    public function createArticle(array $data)
    {
        $article = Article::create($data);

        $article->tags()->attach($data['tags']);

        $article->categories()->attach($data['categories']);

        return $article;
    }

    /**
     * Update an existing article and its associated tags and categories.
     *
     * @param array $data The updated data for the article.
     * @param string $id The ID of the article to update.
     * @return Article
     */
    public function updateArticle(array $data, string $id)
    {
        $article = $this->getArticleById($id);

        $article->update($data);

        $article->tags()->sync($data['tags']);

        $article->categories()->sync($data['categories']);

        return $article;
    }

    /**
     * Delete an article by its ID and detach associated tags and categories.
     *
     * @param string $id The ID of the article to delete.
     * @return Article
     */
    public function deleteArticle(string $id)
    {
        $article = $this->getArticleById($id);

        $article->tags()->detach();

        $article->categories()->detach();

        $article->delete();

        return $article;
    }
}
