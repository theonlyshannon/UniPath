<?php

namespace App\Repositories;

use App\Models\Course;
use App\Models\CourseSyllabus;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Interfaces\CourseRepositoryInterface;

/**
 * Class CourseRepository
 *
 * This class implements the CourseRepositoryInterface and provides methods
 * to manage courses and their syllabi in the application.
 */
class CourseRepository implements CourseRepositoryInterface
{
    /**
     * Retrieve all courses with optional pagination and search functionality.
     *
     * @param int|null $perPage The number of courses per page.
     * @param string|null $search The search term to filter courses by title.
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection
     */
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

    /**
     * Retrieve a limited number of favorite courses.
     *
     * @param int $limit The maximum number of favorite courses to retrieve.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllFavouriteCourses(int $limit = 2)
    {
        return Course::where('is_favourite', true)->take($limit)->get();
    }

    /**
     * Retrieve a course by its ID.
     *
     * @param string $id The ID of the course.
     * @return Course
     */
    public function getCourseById(string $id)
    {
        return Course::findOrFail($id);
    }

    /**
     * Retrieve a course by its slug.
     *
     * @param string $slug The slug of the course.
     * @return Course|null
     */
    public function getCourseBySlug(string $slug)
    {
        return Course::where('slug', $slug)->first();
    }

    /**
     * Create a new course with its syllabus.
     *
     * @param array $data The data for the new course.
     * @return Course
     */
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

    /**
     * Update an existing course and its syllabus.
     *
     * @param array $data The updated data for the course.
     * @param string $id The ID of the course to update.
     * @return Course
     */
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

    /**
     * Update the active status of a course.
     *
     * @param mixed $courseId The ID of the course.
     * @param bool $isActive The new active status.
     * @return void
     */
    public function updateStatusIsActive($courseId, $isActive)
    {
        $course = Course::findOrFail($courseId);

        $course->is_active = $isActive;

        $course->save();
    }

    /**
     * Update the favorite status of a course.
     *
     * @param mixed $courseId The ID of the course.
     * @param bool $isFavourite The new favorite status.
     * @return void
     */
    public function updateStatusIsFavourite($courseId, $isFavourite)
    {
        $course = Course::findOrFail($courseId);

        $course->is_favourite = $isFavourite;

        $course->save();
    }

    /**
     * Delete a course by its ID.
     *
     * @param string $id The ID of the course to delete.
     * @return Course
     */
    public function deleteCourse(string $id)
    {
        return DB::transaction(function () use ($id) {
            $course = $this->getCourseById($id);
            $course->delete();
            return $course;
        });
    }

    /**
     * Retrieve the syllabus for a specific course by its ID.
     *
     * @param string $courseId The ID of the course.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getSyllabusByCourseId(string $courseId)
    {
        return CourseSyllabus::where('course_id', $courseId)->get();
    }
}
