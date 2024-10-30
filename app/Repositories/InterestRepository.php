<?php

namespace App\Repositories;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Interfaces\InterestRepositoryInterface;

class InterestRepository implements InterestRepositoryInterface
{
    public function getAllStudentInterest()
    {
        return Student::all();
    }

    public function getStudentInterestById(string $id)
    {
        return Student::findOrFail($id);
    }

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

    public function updateStudentInterest(array $data, string $id)
    {
        $student = $this->getStudentInterestById($id);
        $student->update($data);
        return $student;
    }

    public function deleteStudentInterest(string $id)
    {
        $student = $this->getStudentInterestById($id);
        return $student->delete();
    }
}
