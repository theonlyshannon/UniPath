<?php

namespace App\Repositories;

use App\Interfaces\CourseReviewRepositoryInterface;
use App\Models\CourseReview;

class CourseReviewRepository implements CourseReviewRepositoryInterface
{
    public function getAllCourseReview(?int $perPage = null, ?string $search = null)
    {
        $review = CourseReview::query();

        if (auth()->check()) {
            if (auth()->user()->hasRole('mentor')) {
                $review->whereHas('course', function ($query) {
                    $query->where('mentor_id', auth()->user()->mentor->id);
                });
            }
        }

        if ($search) {
            $review->where('review', 'like', '%' . $search . '%');
        }

        if ($perPage) {
            return $review->latest()->paginate($perPage);
        }

        return $review->latest()->get();
    }


    public function getCourseReviewByCourseId(string $courseId)
    {
        return CourseReview::where('course_id', $courseId)->get();
    }

    public function getCourseReviewById(string $id)
    {
        return CourseReview::findOrFail($id);
    }

    public function createCourseReview(array $data)
    {
        return CourseReview::create($data);
    }

    public function updateCourseReview(array $data, string $id)
    {
        $review = CourseReview::findOrFail($id);
        $review->update($data);
        return $review;
    }

    public function deleteCourseReview(string $id)
    {
        $review = CourseReview::findOrFail($id);
        $review->delete();
        return $review;
    }
}
