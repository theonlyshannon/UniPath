<?php

namespace App\Http\Controllers\Web\App;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\CourseRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    private $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function index()
    {
        $category = request()->query('category');

        $courses = $this->courseRepository->getAllCourse(8, $category);

        return view('pages.app.course.index', compact('courses'));
    }

    public function show($slug)
{
    $course = $this->courseRepository->getCourseBySlug($slug);

    $user = Auth::user();
    $hasAccess = false;

    if ($user) {
        $hasAccess = $user->hasPurchasedCourse($course->id);
    }

    return view('pages.app.course.show', compact('course', 'hasAccess'));
}



}
