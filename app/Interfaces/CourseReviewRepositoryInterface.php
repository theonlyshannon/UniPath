<?php

namespace App\Interfaces;

interface CourseReviewRepositoryInterface
{
    public function getAllCourseReview(?int $perPage = null, ?string $search = null);

    public function getCourseReviewByCourseId(string $CourseId);

    public function getCourseReviewById(string $id);

    public function updateStatusIsActive(string $courseReviewId, bool $isActive);

    public function deleteCourseReview(string $id);
}
