<?php

namespace App\Interfaces;

interface CourseCategoryRepositoryInterface
{
    public function getAllCourseCategory();

    public function getCourseCategoryById(string $id);

    public function createCourseCategory(array $data);

    public function updateCourseCategory(array $data, string $id);

    public function deleteCourseCategory(string $id);
}
