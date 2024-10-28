<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\CourseSyllabus;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\CourseRepositoryInterface;

class CourseRepository implements CourseRepositoryInterface
{
    public function getAllCourse(?int $perPage = null, ?string $search = null)
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

            if (isset($data['syllabus'])) {
                foreach ($data['syllabus'] as $syllabus) {
                    $syllabusData = [
                        'course_id' => $course->id,
                        'sort' => $syllabus['sort'],
                        'title' => $syllabus['title'],
                        'video' => $syllabus['video'] ?? null,
                    ];

                    if (isset($syllabus['file'])) {
                        $syllabusData['file'] = $syllabus['file']->storeAs('assets/files/course/syllabus', Str::random(40) . '.' . $syllabus['file']->extension());
                    }

                    CourseSyllabus::create($syllabusData);
                }
            }

            return $course;
        });
    }

    public function updateCourse(array $data, string $id)
    {
        return DB::transaction(function () use ($data, $id) {
            $course = $this->getCourseById($id);
            $course->update($data);

            CourseSyllabus::where('course_id', $id)->delete();

            if (isset($data['syllabus'])) {
                foreach ($data['syllabus'] as $syllabus) {
                    $syllabusData = [
                        'course_id' => $course->id,
                        'sort' => $syllabus['sort'],
                        'title' => $syllabus['title'],
                        'video' => $syllabus['video'] ?? null,
                    ];

                    if (isset($syllabus['file'])) {
                        $syllabusData['file'] = $syllabus['file']->storeAs('assets/files/course/syllabus', Str::random(40) . '.' . $syllabus['file']->extension());
                    }

                    CourseSyllabus::create($syllabusData);
                }
            }

            return $course;
        });
    }

    public function updateStatusIsActive($courseId, $isActive)
    {
        $course = Course::findOrFail($courseId);

        $course->is_active = $isActive;

        $course->save();
    }

    public function updateStatusIsFavourite($courseId, $isFavourite)
    {
        $course = Course::findOrFail($courseId);

        $course->is_favourite = $isFavourite;

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

    public function getSyllabusByCourseId(string $courseId)
    {
        return CourseSyllabus::where('course_id', $courseId)->get();
    }
}
