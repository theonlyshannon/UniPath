<?php

namespace App\Repositories;

use App\Interfaces\CourseCategoryRepositoryInterface;
use App\Models\CourseCategory;

class CourseCategoryRepository implements CourseCategoryRepositoryInterface
{
    public function getAllCourseCategory()
    {
        return CourseCategory::all();
    }

    public function getCourseCategoryById(string $id)
    {
        return CourseCategory::findOrFail($id);
    }

    public function createCourseCategory(array $data)
    {
        return CourseCategory::create($data);
    }

    public function updateCourseCategory(array $data, string $id)
    {
        $courseCategory = $this->getCourseCategoryById($id);

        $courseCategory->update($data);

        return $courseCategory;
    }

    public function deleteCourseCategory(string $id)
    {
        $courseCategory = $this->getCourseCategoryById($id);

        $courseCategory->delete();

        return $courseCategory;
    }
}
