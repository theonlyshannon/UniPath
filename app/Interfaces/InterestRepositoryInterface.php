<?php

namespace App\Interfaces;

interface InterestRepositoryInterface
{
    /**
     * Mendapatkan semua data student.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllStudentInterest();

    /**
     * Mendapatkan data student berdasarkan ID.
     *
     * @param string $id
     * @return \App\Models\Student
     */
    public function getStudentInterestById(string $id);

    /**
     * Membuat data student baru.
     *
     * @param array $data
     * @return \App\Models\Student
     */
    public function createStudentInterest(array $data);

    /**
     * Memperbarui data student yang ada.
     *
     * @param array $data
     * @param string $id
     * @return \App\Models\Student
     */
    public function updateStudentInterest(array $data, string $id);

    /**
     * Menghapus data student.
     *
     * @param string $id
     * @return bool
     */
    public function deleteStudentInterest(string $id);
}
