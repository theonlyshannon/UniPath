<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
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

    public function index(Request $request)
    {
        $students = $this->StudentRepository->getAllStudent();
        return view('pages.admin.Student.index', compact('students'));
    }

    public function create()
    {
        return view('pages.admin.Student.create');
    }

    public function store(StoreStudentRequest $request)
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
        $Student = $this->StudentRepository->getStudentById($id);
        return view('pages.admin.Student.show', compact('Student'));
    }

    public function edit($id)
    {
        $Student = $this->StudentRepository->getStudentById($id);
        return view('pages.admin.Student.edit', compact('Student'));
    }

    public function update(StoreStudentRequest $request, $id)
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
