<?php

namespace App\Repositories;

use App\Models\Article;
use Illuminate\Support\Facades\DB;
use App\Interfaces\ArticleRepositoryInterface;

class ArticleRepository implements ArticleRepositoryInterface
{
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

    public function getArticleById(string $id)
    {
        return Article::findOrFail($id);
    }

    public function getArticleBySlug(string $slug)
    {
        return Article::where('slug', $slug)->firstOrFail();
    }

    public function getArticleByCategory(string $category)
    {
        return Article::where('category', $category)->get();
    }

    public function getArticlesCountByDate()
    {
        return DB::table('articles')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();
    }

    public function getArticleByTag(string $tag)
    {
        return Article::where('tag', $tag)->get();
    }

    public function createArticle(array $data)
    {
        $article = Article::create($data);

        $article->tags()->attach($data['tags']);

        $article->categories()->attach($data['categories']);

        return $article;
    }

    public function updateArticle(array $data, string $id)
    {
        $article = $this->getArticleById($id);

        $article->update($data);

        $article->tags()->sync($data['tags']);

        $article->categories()->sync($data['categories']);

        return $article;
    }

    public function deleteArticle(string $id)
    {
        $article = $this->getArticleById($id);

        $article->tags()->detach();

        $article->categories()->detach();

        $article->delete();

        return $article;
    }
}
