<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Interfaces\ArticleCategoryRepositoryInterface;
use App\Interfaces\ArticleRepositoryInterface;
use App\Interfaces\ArticleTagRepositoryInterface;
use App\Interfaces\WriterRepositoryInterface;
use RealRashid\SweetAlert\Facades\Alert as Swal;

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
        $articles = $this->articleRepository->getAllArticle();
        $writers = $this->writerRepository->getAllWriter();

        return view('pages.admin.article-management.article.index', compact('articles', 'writers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->articleCategoryRepository->getAllArticleCategory();
        $tags = $this->articleTagRepository->getAllArticleTag();
        $writers = $this->writerRepository->getAllWriter();

        return view('pages.admin.article-management.article.create', compact('categories', 'tags', 'writers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleStoreRequest $request)
    {
        $data = $request->validated();

        $data['thumbnail'] = $request->file('thumbnail')->store('images/articles', 'public');

        try {
            $this->articleRepository->createArticle($data);

            Swal::toast('Artikel berhasil ditambahkan', 'success');
        } catch (\Exception $e) {
            Swal::toast($e->getMessage(), 'error');
        }

        return redirect()->route('admin.article.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = $this->articleRepository->getArticleById($id);

        return view('pages.admin.article-management.article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = $this->articleRepository->getArticleById($id);

        $categories = $this->articleCategoryRepository->getAllArticleCategory();
        $tags = $this->articleTagRepository->getAllArticleTag();
        $writers = $this->writerRepository->getAllWriter();

        return view('pages.admin.article-management.article.edit', compact('article', 'categories', 'tags', 'writers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUpdateRequest $request, string $id)
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('images/articles', 'public');
        }

        try {
            $this->articleRepository->updateArticle($data, $id);

            Swal::toast('Artikel berhasil diperbarui', 'success');
        } catch (\Exception $e) {
            Swal::toast($e->getMessage(), 'error');
        }

        return redirect()->route('admin.article.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->articleRepository->deleteArticle($id);

            Swal::toast('Article berhasil dihapus', 'success');
        } catch (\Exception $e) {
            Swal::toast('Article gagal dihapus', 'error');
        }

        return redirect()->route('admin.article.index');
    }
}
