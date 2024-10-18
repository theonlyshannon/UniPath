<?php

namespace App\Interfaces;

interface MentorRepositoryInterface
{
    public function getAllMentor(?int $perPage = null);

    public function getMentorByUsername(string $username);

    public function getMentorById(string $id);

    public function createMentor(array $data);

    public function updateMentor(array $data, string $id);

    public function deleteMentor(string $id);
}
