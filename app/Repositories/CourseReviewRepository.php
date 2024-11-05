<?php

namespace App\Repositories;

use App\Interfaces\CourseReviewRepositoryInterface;
use App\Models\CourseReview;

class CourseReviewRepository implements CourseReviewRepositoryInterface
{
    /**
     * Retrieve all course reviews with optional pagination and search functionality.
     *
     * This method fetches course reviews from the database. If the user is authenticated
     * and has the role of 'mentor', it filters the reviews based on the mentor's ID.
     * It also allows searching for reviews by a specific term.
     *
     * @param int|null $perPage The number of reviews per page.
     * @param string|null $search The search term to filter reviews by content.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection
     */
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

    /**
     * Retrieve all reviews for a specific course by its ID.
     *
     * @param string $courseId The ID of the course.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getCourseReviewByCourseId(string $courseId)
    {
        return CourseReview::where('course_id', $courseId)->get();
    }

    /**
     * Retrieve a specific course review by its ID.
     *
     * @param string $id The ID of the course review.
     * @return CourseReview
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getCourseReviewById(string $id)
    {
        return CourseReview::findOrFail($id);
    }

    /**
     * Create a new course review.
     *
     * @param array $data The data for the new course review.
     * @return CourseReview
     */
    public function createCourseReview(array $data)
    {
        return CourseReview::create($data);
    }

    /**
     * Update the active status of a course review.
     *
     * @param mixed $courseReviewId The ID of the course review.
     * @param bool $isActive The new active status.
     * @return void
     */
    public function updateStatusIsActive($courseReviewId, $isActive)
    {
        $course = CourseReview::findOrFail($courseReviewId);

        $course->is_active = $isActive;

        $course->save();
    }

    /**
     * Delete a course review by its ID.
     *
     * @param string $id The ID of the course review to delete.
     * @return CourseReview
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function deleteCourseReview(string $id)
    {
        $review = CourseReview::findOrFail($id);
        $review->delete();
        return $review;
    }
}
