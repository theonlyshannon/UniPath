<?php

namespace App\Repositories;

use App\Interfaces\FacultyRepositoryInterface;
use App\Models\Faculty;

class FacultyRepository implements FacultyRepositoryInterface
{
    /**
     * Find a faculty member by their ID.
     *
     * @param string $id
     * @return Faculty|null
     */
    public function find(string $id): ?Faculty
    {
        return Faculty::with('interests')->find($id);
    }

    /**
     * Get all faculty members.
     *
     * @return \Illuminate\Database\Eloquent\Collection|Faculty[]
     */
    public function getAllFaculty()
    {
        return Faculty::all();
    }

    /**
     * Get a faculty member by their ID, or fail if not found.
     *
     * @param string $id
     * @return Faculty
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getFacultyById(string $id)
    {
        return Faculty::findOrFail($id);
    }

    /**
     * Create a new faculty member.
     *
     * @param array $data
     * @return Faculty
     */
    public function createFaculty(array $data)
    {
        return Faculty::create($data);
    }

    /**
     * Update an existing faculty member.
     *
     * @param array $data
     * @param string $id
     * @return Faculty
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function updateFaculty(array $data, string $id)
    {
        $faculty = Faculty::findOrFail($id);

        $faculty->update($data);

        return $faculty;
    }

    /**
     * Delete a faculty member by their ID.
     *
     * @param string $id
     * @return Faculty
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function deleteFaculty(string $id)
    {
        $faculty = Faculty::findOrFail($id);

        $faculty->delete();

        return $faculty;
    }
}
