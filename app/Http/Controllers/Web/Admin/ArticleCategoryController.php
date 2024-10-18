<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCategoryRequest;
use App\Interfaces\ArticleCategoryRepositoryInterface;
use RealRashid\SweetAlert\Facades\Alert as Swal;


class ArticleCategoryController extends Controller
{
    private $articleCategoryRepository;

    public function __construct(ArticleCategoryRepositoryInterface $articleCategoryRepository)
    {
        $this->articleCategoryRepository = $articleCategoryRepository;

        $this->middleware(['permission:article-category-list|article-category-create|article-category-edit|article-category-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:article-category-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:article-category-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:article-category-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->articleCategoryRepository->getAllArticleCategory();

        return view('pages.admin.article-management.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.article-management.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleCategoryRequest $request)
    {
        $data = $request->validated();

        try {
            $this->articleCategoryRepository->createArticleCategory($data);

            Swal::toast('Kategori artikel berhasil ditambahkan', 'success');
        } catch (\Exception $e) {
            Swal::toast('Kategori artikel gagal ditambahkan', 'error');
        }

        return redirect()->route('admin.article-category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = $this->articleCategoryRepository->getArticleCategoryById($id);

        return view('pages.admin.article-management.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleCategoryRequest $request, string $id)
    {
        $data = $request->validated();

        try {
            $this->articleCategoryRepository->updateArticleCategory($data, $id);

            Swal::toast('Kategori artikel berhasil diperbarui', 'success');
        } catch (\Exception $e) {
            Swal::toast('Kategori artikel gagal diperbarui', 'error');
        }

        return redirect()->route('admin.article-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->articleCategoryRepository->deleteArticleCategory($id);

            Swal::toast('Kategori artikel berhasil dihapus', 'success');
        } catch (\Exception $e) {
            Swal::toast('Kategori artikel gagal dihapus', 'error');
        }

        return redirect()->route('admin.article-category.index');
    }

}
