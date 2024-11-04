<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Interfaces\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    /**
     * Retrieve all roles.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllRole()
    {
        return Role::all();
    }

    /**
     * Retrieve a role by its ID.
     *
     * @param string $id
     * @return Role
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function getRoleById(string $id)
    {
        return Role::findOrFail($id);
    }

    /**
     * Create a new role and sync its permissions.
     *
     * @param array $data
     * @return Role
     */
    public function createRole(array $data)
    {
        $role = Role::create($data);

        $role->syncPermissions($data['permission']);

        return $role;
    }

    /**
     * Update an existing role and sync its permissions.
     *
     * @param array $data
     * @param string $id
     * @return Role
     */
    public function updateRole(array $data, string $id)
    {
        $role = Role::findOrFail($id);
        $role->update($data);

        $role->syncPermissions($data['permission']);

        return $role;
    }

    /**
     * Delete a role by its ID.
     *
     * @param string $id
     * @return Role
     */
    public function deleteRole(string $id)
    {
        $role = Role::findOrFail($id);

        DB::table('model_has_roles')->where('role_id', $id)->delete();

        $role->delete();

        return $role;
    }
}
