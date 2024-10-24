<?php

namespace App\Repositories;

use App\Interfaces\CourseSubjectRepositoryInterface;
use App\Models\CourseSubject;

class CourseSubjectRepository implements CourseSubjectRepositoryInterface
{
    public function getAllCourseSubject()
    {
        return CourseSubject::all();
    }

    public function getCourseSubjectById(string $id)
    {
        return CourseSubject::findOrFail($id);
    }

    public function createCourseSubject(array $data)
    {
        $courseSubjects = [];
        foreach ($data['course_subjects'] as $courseSubject) {
            $courseSubjects[] = CourseSubject::create([
                'subject_file' => $courseSubject['subject_file'],
                'subject_video' => $courseSubject['subject_video'],
            ]);
        }

        return $courseSubjects;
    }

    public function updateCourseSubject(array $data, string $id)
    {
        $courseSubject = $this->getCourseSubjectById($id);

        $courseSubject->update($data);

        return $courseSubject;
    }

    public function deleteCourseSubject(string $id)
    {
        $courseSubject = $this->getCourseSubjectById($id);

        $courseSubject->delete();

        return $courseSubject;
    }
}
