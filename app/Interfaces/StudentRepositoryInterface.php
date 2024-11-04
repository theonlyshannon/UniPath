<?php

namespace App\Interfaces;

interface StudentRepositoryInterface
{
    public function getAllStudent();

    public function getStudentById(string $id);

    public function getStudentData();

    public function getActiveStudentsByDay();

    public function createStudent(array $data);

    public function updateStudent(array $data, string $id);

    public function deleteStudent(string $id);
}
