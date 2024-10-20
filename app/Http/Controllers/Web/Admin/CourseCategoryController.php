<?php

namespace App\Http\Controllers\web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseCategoryStoreRequest;
use App\Http\Requests\CourseCategoryUpdateRequest;
use RealRashid\SweetAlert\Facades\Alert as Swal;
use App\Interfaces\CourseCategoryRepositoryInterface;

class CourseCategoryController extends Controller
{
    private $courseCategoryRepository;

    public function __construct(CourseCategoryRepositoryInterface $courseCategoryRepository)
    {
        $this->courseCategoryRepository = $courseCategoryRepository;

        $this->middleware(['permission:course-category-list|course-category-create|course-category-edit|course-category-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:course-category-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:course-category-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:course-category-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courseCategories = $this->courseCategoryRepository->getAllCourseCategory();

        return view('pages.admin.course-management.course-category.index', compact('courseCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.course-management.course-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseCategoryStoreRequest $request)
    {
        $data = $request->validated();

        try {
            $this->courseCategoryRepository->createCourseCategory($data);

            Swal::toast('Kategori Kelas berhasil ditambahkan', 'success');
        } catch (\Exception $e) {
            Swal::toast('Kategori Kelas gagal ditambahkan', 'error');
        }

        return redirect()->route('admin.course-category.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $courseCategory = $this->courseCategoryRepository->getCourseCategoryById($id);

        return view('pages.admin.course-management.course-category.edit', compact('courseCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseCategoryUpdateRequest $request, string $id)
    {
        $data = $request->validated();

        try {
            $this->courseCategoryRepository->updateCourseCategory($data, $id);

            Swal::toast('Kategori Kelas berhasil diperbarui', 'success');
        } catch (\Exception $e) {
            Swal::toast('Kategori Kelas gagal diperbarui', 'error');
        }

        return redirect()->route('admin.course-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->courseCategoryRepository->deleteCourseCategory($id);

            Swal::toast('Kategori Kelas berhasil dihapus', 'success');
        } catch (\Exception $e) {
            Swal::toast('Kategori Kelas gagal dihapus', 'error');
        }

        return redirect()->route('admin.course-category.index');
    }
}
