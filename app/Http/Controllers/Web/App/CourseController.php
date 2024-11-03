<?php

namespace App\Http\Controllers\Web\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseReviewStoreRequest;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\CourseRepositoryInterface;
use Illuminate\Support\Facades\DB;;
use App\Interfaces\CourseReviewRepositoryInterface;

class CourseController extends Controller
{
    private $courseRepository;
    private $courseReviewRepository;

    public function __construct(CourseRepositoryInterface $courseRepository, CourseReviewRepositoryInterface $courseReviewRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->courseReviewRepository = $courseReviewRepository;
    }

    public function index()
    {
        $category = request()->query('category');

        $courses = $this->courseRepository->getAllCourse(8, $category);


        return view('pages.app.course.index', compact('courses'));
    }

    public function review(CourseReviewStoreRequest $request, string $id)
    {
        $data = $request->validated();
        $course = $this->courseRepository->getCourseById($id);

        $data['student_id'] = Auth::user()->student->id;
        $data['course_id'] = $id;
        $data['is_active'] = false;

        DB::beginTransaction();

        try {

            $this->courseReviewRepository->createCourseReview($data);

            DB::commit();

            return redirect()->route('app.course.show', ['slug' => $course->slug]);
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    }

    public function show($slug)
    {
        $course = $this->courseRepository->getCourseBySlug($slug);
        $reviews = $this->courseReviewRepository->getCourseReviewByCourseId($course->id);

        $user = Auth::user();
        $hasAccess = false;

        if ($user) {
            $hasAccess = $user->hasPurchasedCourse($course->id);
        }

        return view('pages.app.course.show', compact('course', 'hasAccess', 'reviews'));
    }
}
