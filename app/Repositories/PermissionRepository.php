<?php

namespace App\Repositories;

use App\Interfaces\PermissionRepositoryInterface;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function getAllPermission()
    {
        return Permission::all();
    }

    public function getPermissionById(string $id)
    {
        return Permission::findOrFail($id);
    }

    public function createPermission(array $data)
    {
        return Permission::create($data);
    }

    public function updatePermission(array $data, string $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->update($data);

        return $permission;
    }

    public function deletePermission(string $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return $permission;
    }
}
