<?php

namespace App\Http\Controllers\Web\App;

use Illuminate\Http\Request;
use App\Models\ArticleVisitor;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Interfaces\WriterRepositoryInterface;
use App\Interfaces\ArticleRepositoryInterface;
use App\Http\Requests\ArticleCommentStoreRequest;
use App\Interfaces\ArticleTagRepositoryInterface;
use App\Interfaces\ArticleCommentRepositoryInterface;
use App\Interfaces\ArticleCategoryRepositoryInterface;

class ArticleController extends Controller
{
    private $articleRepository;
    private $articleCategoryRepository;
    private $articleTagRepository;
    private $writerRepository;
    private $articleCommentRepository; // Menambahkan properti untuk komentar artikel

    public function __construct(ArticleRepositoryInterface $articleRepository, ArticleCategoryRepositoryInterface $articleCategoryRepository, ArticleTagRepositoryInterface $articleTagRepository, WriterRepositoryInterface $writerRepository, ArticleCommentRepositoryInterface $articleCommentRepository)
    {
        // Menambahkan parameter untuk komentar artikel
        $this->articleRepository = $articleRepository;
        $this->articleCategoryRepository = $articleCategoryRepository;
        $this->articleTagRepository = $articleTagRepository;
        $this->writerRepository = $writerRepository;
        $this->articleCommentRepository = $articleCommentRepository; // Menginisialisasi properti komentar artikel
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

        if (!$article) {
            abort(404);
        }

        $comments = $this->articleCommentRepository->getArticleCommentByArticleId($article->id);
        $categories = $this->articleCategoryRepository->getAllArticleCategory();
        $tags = $this->articleTagRepository->getAllArticleTag();
        $recentArticles = $this->articleRepository->getAllArticle(3);

        $ip = $_SERVER['REMOTE_ADDR'];
        $viewer = ArticleVisitor::where([
            ['visitor_ip', $ip],
            ['article_id', $article->id]
        ])->first();

        if (!$viewer) {
            ArticleVisitor::create([
                'visitor_ip' => $ip,
                'article_id' => $article->id,
            ]);
        }

        return view('pages.app.article.show', compact('article', 'categories', 'tags', 'recentArticles', 'comments'));
    }

    public function comment(ArticleCommentStoreRequest $request, $slug)
    {
        $article = $this->articleRepository->getArticleBySlug($slug);

        if (!$article) {
            abort(404);
        }

        $data = $request->validated();
        $data['article_id'] = $article->id;
        $data['is_approved'] = true;

        DB::beginTransaction();

        try {
            $this->articleCommentRepository->createArticleComment($data);

            DB::commit();

            return redirect()
                ->route('app.article.show', ['slug' => $article->slug])
                ->with('message', 'Komentar berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->route('app.article.show', ['slug' => $article->slug])
                ->with('error', 'Terjadi kesalahan saat menambahkan komentar');
        }
    }
}
