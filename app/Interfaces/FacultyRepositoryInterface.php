<?php

namespace App\Interfaces;

interface FacultyRepositoryInterface
{
    public function getAllFaculty();

    public function getFacultyById(string $id);

    public function createFaculty(array $data);

    public function updateFaculty(array $data, string $id);

    public function deleteFaculty(string $id);
}
