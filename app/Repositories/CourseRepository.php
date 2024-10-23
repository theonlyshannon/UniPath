<?php

namespace App\Repositories;

use App\Interfaces\CourseRepositoryInterface;
use App\Models\Course;
use Illuminate\Support\Facades\DB;

class CourseRepository implements CourseRepositoryInterface
{
    public function getAllcourse(?int $perPage = null, ?string $search = null)
    {
        $courses = Course::query();

        if ($search) {
            $courses->where('title', 'like', '%' . $search . '%');
        }

        $courses->orderBy('is_active', 'desc');

        if ($perPage) {
            return $courses->latest()->paginate($perPage);
        }

        return $courses->latest()->get();
    }

    public function getAllFavouriteCourses(int $limit = 2)
    {
        return Course::where('is_favourite', true)->take($limit)->get();
    }

    public function getCourseById(string $id)
    {
        return Course::findOrFail($id);
    }

    public function getCourseBySlug(string $slug)
    {
        return Course::where('slug', $slug)->first();
    }

    public function createCourse(array $data)
    {
        return DB::transaction(function () use ($data) {

            $course = Course::create($data);

            return $course;
        });
    }

    public function updateCourse(array $data, string $id)
    {
        return DB::transaction(function () use ($data, $id) {
            $course = $this->getCourseById($id);
            $course->update($data);

            return $course;
        });
    }

    public function updateStatus($courseId, $isActive)
    {
        $course = Course::findOrFail($courseId);

        $course->is_active = $isActive;

        $course->save();
    }

    public function deleteCourse(string $id)
    {
        return DB::transaction(function () use ($id) {
            $course = $this->getCourseById($id);
            $course->delete();
            return $course;
        });
    }
}
