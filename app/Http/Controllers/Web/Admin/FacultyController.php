<?php

namespace App\Http\Controllers\web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FacultyStoreRequest;
use App\Http\Requests\FacultyUpdateRequest;
use RealRashid\SweetAlert\Facades\Alert as Swal;
use App\Interfaces\FacultyRepositoryInterface;

class FacultyController extends Controller
{
    private $facultyRepository;

    public function __construct(FacultyRepositoryInterface $facultyRepository)
    {
        $this->facultyRepository = $facultyRepository;

        $this->middleware(['permission:faculty-list|faculty-create|faculty-edit|faculty-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:faculty-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:faculty-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:faculty-delete'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faculties = $this->facultyRepository->getAllFaculty();

        return view('pages.admin.university-management.faculty.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.university-management.faculty.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FacultyStoreRequest $request)
    {
        $data = $request->validated();

        try {
            $this->facultyRepository->createFaculty($data);

            Swal::toast('Fakultas berhasil ditambahkan', 'success');
        } catch (\Exception $e) {
            Swal::toast('Fakultas gagal ditambahkan', 'error');
        }

        return redirect()->route('admin.faculty.index');
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
        $faculty = $this->facultyRepository->getFacultyById($id);

        return view('pages.admin.university-management.faculty.edit', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FacultyUpdateRequest $request, string $id)
    {
        $data = $request->validated();

        try {
            $this->facultyRepository->updateFaculty($data, $id);

            Swal::toast('Fakultas berhasil diperbarui', 'success');
        } catch (\Exception $e) {
            Swal::toast('Fakultas gagal diperbarui', 'error');
        }

        return redirect()->route('admin.faculty.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->facultyRepository->deleteFaculty($id);

            Swal::toast('Fakultas berhasil dihapus', 'success');
        } catch (\Exception $e) {
            Swal::toast('Fakultas gagal dihapus', 'error');
        }

        return redirect()->route('admin.faculty.index');
    }
}
