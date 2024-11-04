<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert as Swal;
use App\Interfaces\ArticleCommentRepositoryInterface;

class ArticleCommentController extends Controller
{
    private $articleCommentRepository;

    public function __construct(ArticleCommentRepositoryInterface $articleCommentRepository)
    {
        $this->articleCommentRepository = $articleCommentRepository;

        $this->middleware(['permission:article-comment-list|article-comment-create|article-comment-edit|article-comment-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:article-comment-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = $this->articleCommentRepository->getAllArticleComments();

        return view('pages.admin.article-management.comment.index', compact('comments'));
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
     * update status function
     */
    public function updateStatusIsActive(Request $request, $articleCommentId)
    {
        try {
            $this->articleCommentRepository->updateStatusIsActive($articleCommentId, $request->is_active);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }
}
