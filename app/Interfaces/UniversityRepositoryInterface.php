<?php

namespace App\Interfaces;

interface UniversityRepositoryInterface
{
    public function getAllUniversity();

    public function getUniversityById(string $id);

    public function createUniversity(array $data);

    public function updateUniversity(array $data, string $id);

    public function deleteUniversity(string $id);
}
