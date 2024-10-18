<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleTagRequest;
use App\Interfaces\ArticleTagRepositoryInterface;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class ArticleTagController extends Controller
{
    private $articleTagRepository;

    public function __construct(ArticleTagRepositoryInterface $articleTagRepository)
    {
        $this->articleTagRepository = $articleTagRepository;

        $this->middleware(['permission:article-tag-list|article-tag-create|article-tag-edit|article-tag-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:article-tag-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:article-tag-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:article-tag-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = $this->articleTagRepository->getAllArticleTag();

        return view('pages.admin.article-management.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.article-management.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleTagRequest $request)
    {
        $data = $request->validated();

        try {
            $this->articleTagRepository->createArticleTag($data);

            Swal::toast('Tag artikel berhasil ditambahkan', 'success');
        } catch (\Exception $e) {
            Swal::toast('Tag artikel gagal ditambahkan', 'error');
        }

        return redirect()->route('admin.article-tag.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tag = $this->articleTagRepository->getArticleTagById($id);

        return view('pages.admin.article-managements.tag.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tag = $this->articleTagRepository->getArticleTagById($id);

        return view('pages.admin.article-managements.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleTagRequest $request, string $id)
    {
        $data = $request->validated();

        try {
            $this->articleTagRepository->updateArticleTag($data, $id);

            Swal::toast('Tag artikel berhasil diperbarui', 'success');
        } catch (\Exception $e) {
            Swal::toast('Tag artikel gagal diperbarui', 'error');
        }

        return redirect()->route('admin.article-tag.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->articleTagRepository->deleteArticleTag($id);

            Swal::toast('Tag artikel berhasil dihapus', 'success');
        } catch (\Exception $e) {
            Swal::toast('Tag artikel gagal dihapus', 'error');
        }

        return redirect()->route('admin.article-tag.index');
    }
}
