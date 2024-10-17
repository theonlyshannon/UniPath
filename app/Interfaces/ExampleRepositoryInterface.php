<?php

namespace App\Interfaces;

interface ExampleRepositoryInterface
{
    public function getAllExample();
    public function getExampleById(string $id);
    public function createExample(array $data);
    public function updateExample(array $data, string $id);
    public function deleteExample(string $id);
}
