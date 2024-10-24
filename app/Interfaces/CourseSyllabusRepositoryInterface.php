<?php

namespace App\Interfaces;

interface CourseSyllabusRepositoryInterface
{
    public function getAllCourseSyllabus();

    public function getCourseSyllabusById(string $id);

    public function createCourseSyllabus(array $data);

    public function updateCourseSyllabus(array $data, string $id);

    public function deleteCourseSyllabus(string $id);
}
