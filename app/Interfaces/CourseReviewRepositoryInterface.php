<?php

namespace App\Interfaces;

interface CourseReviewRepositoryInterface
{
    public function getAllCourseReview(?int $perPage = null, ?string $search = null);

    public function getCourseReviewByCourseId(string $CourseId);

    public function getCourseReviewById(string $id);

    public function createCourseReview(array $data);

    public function updateCourseReview(array $data, string $id);

    public function deleteCourseReview(string $id);
}
