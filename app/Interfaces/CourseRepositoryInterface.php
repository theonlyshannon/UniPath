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

    public function updateStatusIsActive(string $courseId, bool $isActive);

    public function updateStatusIsFavourite(string $courseId, bool $isFavourite);

    public function deleteCourse(string $id);
}

