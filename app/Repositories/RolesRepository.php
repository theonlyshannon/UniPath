<?php

namespace App\Repositories;

use App\Models\Roles;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Interfaces\RolesRepositoryInterface;

class RolesRepository implements RolesRepositoryInterface
{
    public function getAllRoles()
    {
        return Role::all();
    }

    public function getRolesById(string $id)
    {
        return Role::findOrFail($id);
    }

    public function createRoles(array $data)
    {
        $role = Role::create($data);

        $role->syncPermissions($data['permission']);

        return $role;
    }

    public function updateRoles(array $data, string $id)
    {
        $role = Role::findOrFail($id);
        $role->update($data);

        $role->syncPermissions($data['permission']);

        return $role;
    }

    public function deleteRoles(string $id)
    {
        $role = Role::findOrFail($id);

        DB::table('model_has_roles')->where('role_id', $id)->delete();
        $role->delete();

        return $role;
    }
}
