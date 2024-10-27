<?php

namespace App\Http\Controllers\Web\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\ArticleRepositoryInterface;
use App\Interfaces\ArticleTagRepositoryInterface;
use App\Interfaces\ArticleCategoryRepositoryInterface;

class ArticleController extends Controller
{
    private $articleRepository;
    private $articleCategoryRepository;
    private $articleTagRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository, ArticleCategoryRepositoryInterface $articleCategoryRepository, ArticleTagRepositoryInterface $articleTagRepository)
    {
        $this->articleRepository = $articleRepository;

        $this->articleCategoryRepository = $articleCategoryRepository;

        $this->articleTagRepository = $articleTagRepository;
    }

    public function index()
    {
        $category = request()->query('category');
        $tag = request()->query('tag');

        $articles = $this->articleRepository->getAllArticle(5, $category, $tag);
        $categories = $this->articleCategoryRepository->getAllArticleCategory();
        $tags = $this->articleTagRepository->getAllArticleTag();

        return view('pages.app.article.index', compact('articles', 'categories', 'tags'));
    }

    public function show($slug)
    {
        $article = $this->articleRepository->getArticleBySlug($slug);

        $categories = $this->articleCategoryRepository->getAllArticleCategory();
        $tags = $this->articleTagRepository->getAllArticleTag();
        $relatedArticles = $this->articleRepository->getAllArticle(3, null, $article->categories->first()->slug, null)->except($article->id);
        $recentArticles = $this->articleRepository->getAllArticle(3);

        return view('pages.app.article.show', compact('article', 'comments', 'categories', 'tags', 'relatedArticles', 'recentArticles'));
    }

}
