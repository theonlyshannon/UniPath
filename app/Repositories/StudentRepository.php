<?php

namespace App\Repositories;

use App\Interfaces\StudentRepositoryInterface;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class StudentRepository implements StudentRepositoryInterface
{
    public function getAllStudent()
    {
        return Student::all();
    }

    public function getStudentById(string $id)
    {
        return Student::findOrFail($id);
    }

    public function getStudentData()
    {
        return DB::table('students')->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))->groupBy('date')->orderBy('date', 'ASC')->get();
    }

    public function createStudent(array $data)
    {
        DB::beginTransaction();

        $user = User::create($data);

        if ($data['role'] == 'student') {
            $user->assignRole('student');

            $user->student()->create([
                'name' => $data['name'],
                'username' => $this->generateUsername($data['email']),
                'email' => $data['email'],
                'password' => $data['password'],
                'gender' => $data['gender'],
                'city' => $data['city'],
                'phone' => $data['phone'],
            ]);
        }

        DB::commit();

        return $user;
    }

    public function updateStudent(array $data, string $id)
    {
        $student = Student::findOrFail($id);
        $student->update($data);

        return $student;
    }

    public function deleteStudent(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return $student;
    }

    private function generateUsername(string $email)
    {
        return strstr($email, '@', true) . Student::count();
    }
}
