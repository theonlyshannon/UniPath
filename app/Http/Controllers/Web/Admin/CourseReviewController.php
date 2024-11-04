<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert as Swal;
use App\Interfaces\CourseReviewRepositoryInterface;

class CourseReviewController extends Controller
{
    private $courseReviewRepository;

    public function __construct(CourseReviewRepositoryInterface $courseReviewRepository)
    {
        $this->courseReviewRepository = $courseReviewRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = $this->courseReviewRepository->getAllCourseReview();

        return view('pages.admin.course-management.course-review.index', compact('reviews'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->courseReviewRepository->deleteCourseReview($id);

            Swal::toast('Review kursus berhasil dihapus', 'success');
        } catch (\Exception $e) {
            Swal::toast('Review kursus gagal dihapus', 'error');
        }

        return redirect()->route('admin.course-review.index');
    }

    /**
     * update status function 
     */
    public function updateStatusIsActive(Request $request, $courseReviewId)
    {
        try {
            $this->courseReviewRepository->updateStatusIsActive($courseReviewId, $request->is_active);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }
}
