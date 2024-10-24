<?php

namespace App\Interfaces;

interface CourseRepositoryInterface
{
    public function getAllCourse(?int $perPage = null, ?string $search = null);

    public function getAllFavouriteCourses(int $limit = 2);

    public function getCourseById(string $id);

    public function getCourseBySlug(string $slug);

    public function createCourse(array $data);

    public function updateCourse(array $data, string $id);

    public function updateStatus(string $courseId, bool $isActive);

    public function deleteCourse(string $id);
}

