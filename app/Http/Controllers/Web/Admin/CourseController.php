<?php

namespace App\Http\Controllers\web\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseStoreRequest;
use App\Interfaces\CourseRepositoryInterface;
use App\Interfaces\MentorRepositoryInterface;
use RealRashid\SweetAlert\Facades\Alert as Swal;
use App\Interfaces\CourseCategoryRepositoryInterface;


class CourseController extends Controller
{
    private $courseRepository;
    private $mentorRepository;
    private $courseCategoryRepository;

    public function __construct(CourseRepositoryInterface $courseRepository, MentorRepositoryInterface $mentorRepository, CourseCategoryRepositoryInterface $courseCategoryRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->mentorRepository = $mentorRepository;
        $this->courseCategoryRepository = $courseCategoryRepository;

        $this->middleware(['permission:course-list'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:course-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:course-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:course-delete'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = $this->courseRepository->getAllCourse();

        return view('pages.admin.course-management.course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mentors = $this->mentorRepository->getAllMentor();
        $categories = $this->courseCategoryRepository->getAllCourseCategory();

        return view('pages.admin.course-management.course.create', compact('mentors', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseStoreRequest $request)
    {
        $data = $request->validated();

        $data['thumbnail'] = $request->file('thumbnail')->storeAs('assets/images/course/thumbnail', Str::random(40) . '.' . $request->file('thumbnail')->extension(), 'public');

        try {
            $this->courseRepository->createCourse($data);

            Swal::toast('Course berhasil ditambahkan', 'success');
        } catch (\Exception $e) {
            Swal::toast('Course gagal ditambahkan', 'error');
        }

        return redirect()->route('admin.course.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = $this->courseRepository->getCourseById($id);

        return view('pages.admin.course-management.course.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course = $this->courseRepository->getCourseById($id);

        $mentors = $this->mentorRepository->getAllMentor();
        $categories = $this->courseCategoryRepository->getAllCourseCategory();

        return view('pages.admin.course-managements.course.edit', compact('course', 'mentors', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
