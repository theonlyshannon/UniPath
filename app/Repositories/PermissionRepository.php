<?php

namespace App\Repositories;

use App\Interfaces\PermissionRepositoryInterface;
use Spatie\Permission\Models\Permission;

class PermissionRepository implements PermissionRepositoryInterface
{
    /**
     * Retrieve all permissions.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllPermission()
    {
        return Permission::all();
    }

    /**
     * Retrieve a permission by its ID.
     *
     * @param string $id
     * @return Permission
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getPermissionById(string $id)
    {
        return Permission::findOrFail($id);
    }

    /**
     * Create a new permission.
     *
     * @param array $data
     * @return Permission
     */
    public function createPermission(array $data)
    {
        return Permission::create($data);
    }

    /**
     * Update an existing permission.
     *
     * @param array $data
     * @param string $id
     * @return Permission
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function updatePermission(array $data, string $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->update($data);

        return $permission;
    }

    /**
     * Delete a permission by its ID.
     *
     * @param string $id
     * @return Permission
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function deletePermission(string $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();

        return $permission;
    }
}
