<?php

namespace App\Repositories;

use App\Interfaces\UniversityRepositoryInterface;
use App\Models\University;

class UniversityRepository implements UniversityRepositoryInterface
{
    public function find(string $id): ?University
    {
        return University::with('interests')->find($id);
    }
    
    public function getAllUniversity()
    {
        return University::all();
    }

    public function getUniversityById(string $id)
    {
        return University::findOrFail($id);
    }

    public function createUniversity(array $data)
    {
        return University::create($data);
    }

    public function updateUniversity(array $data, string $id)
    {
        $university = $this->getUniversityById($id);

        $university->update($data);

        return $university;
    }

    public function deleteUniversity(string $id)
    {
        $university = $this->getUniversityById($id);

        $university->delete();

        return $university;
    }
}
