<?php

namespace App\Repositories;

use App\Interfaces\StudentRepositoryInterface;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/**
 * Class StudentRepository
 * This class implements the StudentRepositoryInterface and provides methods
 * to manage student data. It allows for retrieving, creating, updating,
 * and deleting student records.
 */
class StudentRepository implements StudentRepositoryInterface
{
    /**
     * Retrieve all students.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllStudent()
    {
        return Student::all();
    }

    /**
     * Retrieve a student by their ID.
     *
     * @param string $id
     * @return Student
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getStudentById(string $id)
    {
        return Student::findOrFail($id);
    }

    /**
     * Retrieve student data grouped by creation date.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getStudentData()
    {
        return DB::table('students')->select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(*) as count'))->groupBy('date')->orderBy('date', 'ASC')->get();
    }

    /**
     * Retrieve active students grouped by the day of last activity.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getActiveStudentsByDay()
    {
        return Student::select(DB::raw('DATE(last_active_at) as date'), DB::raw('COUNT(*) as count'))
            ->whereNotNull('last_active_at')
            ->groupBy('date')
            ->orderBy('date', 'ASC')
            ->get();
    }

    /**
     * Create a new student and associated user.
     *
     * @param array $data
     * @return User
     */
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

    /**
     * Update an existing student.
     *
     * @param array $data
     * @param string $id
     * @return Student
     */
    public function updateStudent(array $data, string $id)
    {
        $student = Student::findOrFail($id);
        $student->update($data);

        return $student;
    }

    /**
     * Delete a student by their ID.
     *
     * @param string $id
     * @return Student
     */
    public function deleteStudent(string $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return $student;
    }

    /**
     * Generate a username based on the student's email.
     *
     * @param string $email
     * @return string
     */
    private function generateUsername(string $email)
    {
        return strstr($email, '@', true) . Student::count();
    }
}
