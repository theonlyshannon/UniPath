<?php

namespace App\Interfaces;

interface CourseSubjectRepositoryInterface
{
    public function getAllCourseSubject();

    public function getCourseSubjectById(string $id);

    public function createCourseSubject(array $data);

    public function updateCourseSubject(array $data, string $id);

    public function deleteCourseSubject(string $id);
}
