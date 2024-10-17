<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Interfaces\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{
    public function getAllRole()
    {
        return Role::all();
    }

    public function getRoleById(string $id)
    {
        return Role::findOrFail($id);
    }

    public function createRole(array $data)
    {
        $role = Role::create($data);

        $role->syncPermissions($data['permission']);

        return $role;
    }

    public function updateRole(array $data, string $id)
    {
        $role = Role::findOrFail($id);
        $role->update($data);

        $role->syncPermissions($data['permission']);

        return $role;
    }

    public function deleteRole(string $id)
    {
        $role = Role::findOrFail($id);

        DB::table('model_has_roles')->where('role_id', $id)->delete();

        $role->delete();

        return $role;
    }
}
