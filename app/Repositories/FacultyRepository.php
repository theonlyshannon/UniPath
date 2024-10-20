<?php

namespace App\Repositories;

use App\Interfaces\FacultyRepositoryInterface;
use App\Models\Faculty;

class FacultyRepository implements FacultyRepositoryInterface
{
    public function getAllFaculty()
    {
        return Faculty::all();
    }

    public function getFacultyById(string $id)
    {
        return Faculty::findOrFail($id);
    }

    public function createFaculty(array $data)
    {
        return Faculty::create($data);
    }

    public function updateFaculty(array $data, string $id)
    {
        $faculty = Faculty::findOrFail($id);

        $faculty->update($data);

        return $faculty;
    }

    public function deleteFaculty(string $id)
    {
        $faculty = Faculty::findOrFail($id);

        $faculty->delete();

        return $faculty;
    }
}
