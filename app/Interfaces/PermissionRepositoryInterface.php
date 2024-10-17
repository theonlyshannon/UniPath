<?php

namespace App\Interfaces;

interface PermissionRepositoryInterface
{
    public function getAllPermission();

    public function getPermissionById(string $id);

    public function createPermission(array $data);

    public function updatePermission(array $data, string $id);

    public function deletePermission(string $id);
}
