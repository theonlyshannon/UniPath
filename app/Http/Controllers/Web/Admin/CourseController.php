<?php

namespace App\Http\Controllers\web\Admin;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CourseSyllabus;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseStoreRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Interfaces\CourseRepositoryInterface;
use App\Interfaces\MentorRepositoryInterface;
use RealRashid\SweetAlert\Facades\Alert as Swal;
use App\Interfaces\CourseCategoryRepositoryInterface;
use Illuminate\Support\Facades\Log;

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

        return view('pages.admin.course-management.course.create', compact('mentors', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseStoreRequest $request)
    {
        $data = $request->validated();

        // Log data yang divalidasi
        Log::info('CourseStoreRequest validated data:', $data);

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->storeAs('assets/images/course/thumbnail', Str::random(40) . '.' . $request->file('thumbnail')->extension(), 'public');
            $data['thumbnail'] = $thumbnailPath;

            // Log path thumbnail
            Log::info('Thumbnail stored at:', ['path' => $thumbnailPath]);
        }

        try {
            $this->courseRepository->createCourse($data);
            Swal::toast('Course berhasil ditambahkan', 'success');
            Log::info('Course created successfully.');
        } catch (\Exception $e) {
            // Log exception
            Log::error('Error creating course:', ['message' => $e->getMessage()]);
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

        $mentor = $this->mentorRepository->getAllMentor();
        $category = $this->courseCategoryRepository->getAllCourseCategory();

        return view('pages.admin.course-management.course.edit', compact('course', 'mentor', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseUpdateRequest $request, string $id)
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->storeAs('assets/images/course/thumbnail', Str::random(40) . '.' . $request->file('thumbnail')->extension(), 'public');
        }

        try {
            $this->courseRepository->updateCourse($data, $id);
            Swal::toast('Course berhasil diperbarui', 'success');
        } catch (\Exception $e) {
            Swal::toast('Course gagal diperbarui', 'error');
        }

        return redirect()->route('admin.course.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->courseRepository->deleteCourse($id);

            Swal::toast('Course berhasil dihapus', 'success');
        } catch (\Exception $e) {
            Swal::toast('Course gagal dihapus', 'error');
        }

        return redirect()->route('admin.course.index');
    }
}
