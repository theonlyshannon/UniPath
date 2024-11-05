<?php

namespace App\Repositories;

use App\Interfaces\UniversityRepositoryInterface;
use App\Models\University;

class UniversityRepository implements UniversityRepositoryInterface
{
    /**
     * Find a university by its ID, including its interests.
     *
     * @param string $id
     * @return University|null
     */
    public function find(string $id): ?University
    {
        return University::with('interests')->find($id);
    }

    /**
     * Retrieve all universities.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllUniversity()
    {
        return University::all();
    }

    /**
     * Retrieve a university by its ID.
     *
     * @param string $id
     * @return University
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getUniversityById(string $id)
    {
        return University::findOrFail($id);
    }

    /**
     * Create a new university.
     *
     * @param array $data
     * @return University
     */
    public function createUniversity(array $data)
    {
        return University::create($data);
    }

    /**
     * Update an existing university.
     *
     * @param array $data
     * @param string $id
     * @return University
     */
    public function updateUniversity(array $data, string $id)
    {
        $university = $this->getUniversityById($id);

        $university->update($data);

        return $university;
    }

    /**
     * Delete a university by its ID.
     *
     * @param string $id
     * @return University
     */
    public function deleteUniversity(string $id)
    {
        $university = $this->getUniversityById($id);

        $university->delete();

        return $university;
    }
}
