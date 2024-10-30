<?php

namespace App\Http\Controllers\Web\App;

use Illuminate\Http\Request;
use App\Models\ArticleVisitor;
use App\Http\Controllers\Controller;
use App\Interfaces\WriterRepositoryInterface;
use App\Interfaces\ArticleRepositoryInterface;
use App\Interfaces\ArticleTagRepositoryInterface;
use App\Interfaces\ArticleCategoryRepositoryInterface;

class ArticleController extends Controller
{
    private $articleRepository;
    private $articleCategoryRepository;
    private $articleTagRepository;
    private $writerRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository, ArticleCategoryRepositoryInterface $articleCategoryRepository, ArticleTagRepositoryInterface $articleTagRepository, WriterRepositoryInterface $writerRepository)
    {
        $this->articleRepository = $articleRepository;

        $this->articleCategoryRepository = $articleCategoryRepository;

        $this->articleTagRepository = $articleTagRepository;

        $this->writerRepository = $writerRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = request()->query('category');
        $tag = request()->query('tag');

        $articles = $this->articleRepository->getAllArticle(5, $category, $tag);
        $categories = $this->articleCategoryRepository->getAllArticleCategory();
        $tags = $this->articleTagRepository->getAllArticleTag();
        $writers = $this->writerRepository->getAllWriter();

        return view('pages.app.article.index', compact('articles', 'categories', 'tags', 'writers'));
    }

    public function show($slug)
    {
        $article = $this->articleRepository->getArticleBySlug($slug);

        $categories = $this->articleCategoryRepository->getAllArticleCategory();
        $tags = $this->articleTagRepository->getAllArticleTag();
        $recentArticles = $this->articleRepository->getAllArticle(3);

        $ip = $_SERVER['REMOTE_ADDR'];
        $viewer = ArticleVisitor::where([['visitor_ip', $ip], ['article_id', $article->id]])->first();

        if (!$viewer) {
            ArticleVisitor::create([
                'visitor_ip' => $ip,
                'article_id' => $article->id,
            ]);
        }

        if (!$article) {
            abort(404);
        }

        return view('pages.app.article.show', compact('article', 'categories', 'tags', 'recentArticles'));
    }

}
