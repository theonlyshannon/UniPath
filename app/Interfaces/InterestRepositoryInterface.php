<?php

namespace App\Interfaces;

interface InterestRepositoryInterface
{
    public function getAllStudentInterest();

    public function getStudentInterestById(string $id);

    public function createStudentInterest(array $data);

    public function updateStudentInterest(array $data, string $id);

    public function deleteStudentInterest(string $id);
}
