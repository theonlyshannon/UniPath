<?php

namespace App\Interfaces;

interface RolesRepositoryInterface
{
    public function getAllRoles();
    
    public function getRolesById(string $id);
    public function createRoles(array $data);
    public function updateRoles(array $data, string $id);
    public function deleteRoles(string $id);
}
