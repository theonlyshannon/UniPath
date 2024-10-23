<?php

namespace App\Http\Controllers\web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseSubjectStoreRequest;
use App\Http\Requests\CourseSubjectUpdateRequest;
use App\Interfaces\CourseSubjectRepositoryInterface;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class CourseSubjectController extends Controller
{
    private $courseSubjectRepository;

    public function __construct(CourseSubjectRepositoryInterface $courseSubjectRepository)
    {
        $this->courseSubjectRepository = $courseSubjectRepository;

        $this->middleware(['permission:course-subject-list'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:course-subject-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:course-subject-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:course-subject-delete'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courseSubjects = $this->courseSubjectRepository->getAllCourseSubject();

        return view('pages.admin.course-management.course-subject.index', compact('courseSubjects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.course-management.course-subject.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseSubjectStoreRequest $request)
    {
        $data = $request->validated();

        try {
            $this->courseSubjectRepository->createCourseSubject($data);

            Swal::toast('Materi Kelas berhasil ditambahkan', 'success');
        } catch (\Exception $e) {
            Swal::toast('Materi Kelas gagal ditambahkan', 'error');
        }

        return redirect()->route('admin.course-subject.index');
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
        $courseSubject = $this->courseSubjectRepository->getCourseSubjectById($id);

        return view('pages.admin.course-management.course-subject.edit', compact('courseSubject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseSubjectUpdateRequest $request, string $id)
    {
        $data = $request->validated();

        try {
            $this->courseSubjectRepository->updateCourseSubject($data, $id);

            Swal::toast('Materi Kelas berhasil diupdate', 'success');
        } catch (\Exception $e) {
            Swal::toast('Materi Kelas gagal diupdate', 'error');
        }

        return redirect()->route('admin.course-subject.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
