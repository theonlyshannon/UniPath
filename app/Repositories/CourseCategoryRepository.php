<?php

namespace App\Repositories;

use App\Interfaces\CourseCategoryRepositoryInterface;
use App\Models\CourseCategory;

class CourseCategoryRepository implements CourseCategoryRepositoryInterface
{
    /**
     * Retrieve all course categories.
     *
     * This method fetches all course categories from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllCourseCategory()
    {
        return CourseCategory::all();
    }

    /**
     * Retrieve a specific course category by its ID.
     *
     * This method fetches a course category based on the provided ID.
     * If the category is not found, it throws a ModelNotFoundException.
     *
     * @param string $id The ID of the course category.
     * @return CourseCategory
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getCourseCategoryById(string $id)
    {
        return CourseCategory::findOrFail($id);
    }

    /**
     * Create a new course category.
     *
     * This method creates a new course category in the database using the provided data.
     *
     * @param array $data The data for the new course category.
     * @return CourseCategory
     */
    public function createCourseCategory(array $data)
    {
        return CourseCategory::create($data);
    }

    /**
     * Update an existing course category.
     *
     * This method updates the course category with the specified ID using the provided data.
     *
     * @param array $data The new data for the course category.
     * @param string $id The ID of the course category to update.
     * @return CourseCategory
     */
    public function updateCourseCategory(array $data, string $id)
    {
        $courseCategory = $this->getCourseCategoryById($id);

        $courseCategory->update($data);

        return $courseCategory;
    }

    /**
     * Delete a course category by its ID.
     *
     * This method deletes the course category with the specified ID from the database.
     *
     * @param string $id The ID of the course category to delete.
     * @return CourseCategory
     */
    public function deleteCourseCategory(string $id)
    {
        $courseCategory = $this->getCourseCategoryById($id);

        $courseCategory->delete();

        return $courseCategory;
    }
}
