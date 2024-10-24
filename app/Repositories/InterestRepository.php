<?php

namespace App\Repositories;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Interfaces\InterestRepositoryInterface;

class InterestRepository implements InterestRepositoryInterface
{
    /**
     * Mendapatkan semua data student.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllStudentInterest()
    {
        return Student::all();
    }

    /**
     * Mendapatkan data student berdasarkan ID.
     *
     * @param string $id
     * @return \App\Models\Student
     */
    public function getStudentInterestById(string $id)
    {
        return Student::findOrFail($id);
    }

    /**
     * Membuat data student baru.
     *
     * @param array $data
     * @return \App\Models\Student
     */
    public function createStudentInterest(array $data)
    {
        $user = Auth::user();

        $data['id'] = (string) Str::uuid();
        $data['username'] = strtolower(str_replace(' ', '.', strstr($user->email, '@', true))) . rand(100, 999);

        // Mengecek apakah student sudah ada sebelumnya
        if ($user->student) {
            $user->student->update($data);
            return $user->student;
        }

        return $user->student()->create($data);
    }

    /**
     * Memperbarui data student yang ada.
     *
     * @param array $data
     * @param string $id
     * @return \App\Models\Student
     */
    public function updateStudentInterest(array $data, string $id)
    {
        $student = $this->getStudentInterestById($id);
        $student->update($data);
        return $student;
    }

    /**
     * Menghapus data student.
     *
     * @param string $id
     * @return bool
     */
    public function deleteStudentInterest(string $id)
    {
        $student = $this->getStudentInterestById($id);
        return $student->delete();
    }
}
