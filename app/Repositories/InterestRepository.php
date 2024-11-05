<?php

namespace App\Repositories;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Interfaces\InterestRepositoryInterface;

/**
 * Class InterestRepository
 *
 * This class implements the InterestRepositoryInterface and provides methods
 * to manage student interests. It allows for retrieving, creating, updating,
 * and deleting student interests.
 */
class InterestRepository implements InterestRepositoryInterface
{
    /**
     * Retrieve all student interests.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllStudentInterest()
    {
        return Student::all();
    }

    /**
     * Retrieve a student interest by its ID.
     *
     * @param string $id
     * @return Student
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getStudentInterestById(string $id)
    {
        return Student::findOrFail($id);
    }

    /**
     * Create a new student interest or update an existing one.
     *
     * @param array $data
     * @return Student
     */
    public function createStudentInterest(array $data)
    {
        $user = Auth::user();

        $data['id'] = (string) Str::uuid();
        $data['username'] = strtolower(str_replace(' ', '.', strstr($user->email, '@', true))) . rand(100, 999);

        if ($user->student) {
            $user->student->update($data);
            return $user->student;
        }

        return $user->student()->create($data);
    }

    /**
     * Update an existing student interest.
     *
     * @param array $data
     * @param string $id
     * @return Student
     */
    public function updateStudentInterest(array $data, string $id)
    {
        $student = $this->getStudentInterestById($id);
        $student->update($data);
        return $student;
    }

    /**
     * Delete a student interest by its ID.
     *
     * @param string $id
     * @return bool|null
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function deleteStudentInterest(string $id)
    {
        $student = $this->getStudentInterestById($id);
        return $student->delete();
    }
}
