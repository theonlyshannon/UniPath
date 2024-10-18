<?php

namespace App\Interfaces;

interface WriterRepositoryInterface
{
    public function getAllWriter();

    public function getWriterById(string $id);

    public function createWriter(array $data);

    public function updateWriter(array $data, string $id);

    public function deleteWriter(string $id);
}
