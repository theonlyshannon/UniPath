<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Interfaces\StudentRepositoryInterface;
use RealRashid\SweetAlert\Facades\Alert as Swal;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $StudentRepository;

    public function __construct(StudentRepositoryInterface $StudentRepository)
    {
        $this->StudentRepository = $StudentRepository;
    }

    public function index()
    {
        $students = $this->StudentRepository->getAllStudent();
        
        return view('pages.admin.account-management.student.index', compact('students'));
    }

    public function create()
    {
        return view('pages.admin.account-management.student.create');
    }

    public function store(StudentStoreRequest $request)
    {
        $request->validated();

        $request->merge(['role' => 'student']);

        $data = $request->all();

        try {
            $this->StudentRepository->createStudent($data);

            Swal::toast('Student berhasil ditambahkan', 'success');
        } catch (\Exception $e) {
            Swal::toast('Student gagal ditambahkan', 'error');
        }

        return redirect()->route('admin.student.index');

    }

    public function show($id)
    {
        $student = $this->StudentRepository->getStudentById($id);

        return view('pages.admin.account-management.student.show', compact('student'));
    }

    public function edit($id)
    {
        $student = $this->StudentRepository->getStudentById($id);

        return view('pages.admin.account-management.student.edit', compact('student'));
    }

    public function update(StudentUpdateRequest $request, $id)
    {
        $data = $request->validated();

        $this->StudentRepository->updateStudent($data, $id);

        Swal::toast('Student updated successfully!', 'success')->timerProgressBar();

        return redirect()->route('admin.student.index');
    }

    public function destroy($id)
    {
        $this->StudentRepository->deleteStudent($id);

        Swal::toast('Student deleted successfully!', 'success')->timerProgressBar();

        return redirect()->route('admin.student.index');
    }
}
