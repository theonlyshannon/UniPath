<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ArticleCommentRepositoryInterface;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class ArticleCommentController extends Controller
{
    private $articleCommentRepository;

    public function __construct(ArticleCommentRepositoryInterface $articleCommentRepository)
    {
        $this->articleCommentRepository = $articleCommentRepository;

        $this->middleware(['permission:article-comment-list|article-comment-create|article-comment-edit|article-comment-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:article-comment-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:article-comment-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:article-comment-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = $this->articleCommentRepository->getAllArticleComments();

        return view('pages.admin.article-managements.comment.index', compact('comments'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->articleCommentRepository->deleteArticleComment($id);

            Swal::toast('Komentar artikel berhasil dihapus', 'success');
        } catch (\Exception $e) {
            Swal::toast('Komentar artikel gagal dihapus', 'error');
        }

        return redirect()->route('admin.article-comment.index');
    }

    /**
     * Approve the specified resource from storage.
     */
    public function approve(string $id)
    {
        try {
            $this->articleCommentRepository->updateArticleComment(['is_approved' => true], $id);

            Swal::toast('Komentar artikel berhasil disetujui', 'success');
        } catch (\Exception $e) {
            Swal::toast('Komentar artikel gagal disetujui', 'error');
        }

        return redirect()->route('admin.article-comment.index');
    }

    /**
     * Reject the specified resource from storage.
     */
    public function reject(string $id)
    {
        try {
            $this->articleCommentRepository->updateArticleComment(['is_approved' => false], $id);

            Swal::toast('Komentar artikel berhasil tidak disetujui', 'success');
        } catch (\Exception $e) {
            Swal::toast('Komentar artikel gagal tidak disetujui', 'error');
        }

        return redirect()->route('admin.article-comment.index');
    }
}
