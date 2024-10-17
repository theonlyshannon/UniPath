<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRolesRequest;
use App\Interfaces\RoleRepositoryInterface;
use RealRashid\SweetAlert\Facades\Alert as Swal;
use App\Interfaces\PermissionRepositoryInterface;

class RoleController extends Controller
{
    private $roleRepository;

    private $permissionRepository;

    public function __construct(RoleRepositoryInterface $roleRepository, PermissionRepositoryInterface $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;

        $this->middleware(['permission:role-list|role-create|role-edit|role-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:role-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:role-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:role-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = $this->roleRepository->getAllRole();

        return view('pages.admin.account-management.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = $this->permissionRepository->getAllPermission();

        return view('pages.admin.account-management.role.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request)
    {
        $data = $request->validated();

        try {
            $this->roleRepository->createRole($data);

            Swal::toast('Role berhasil ditambahkan', 'success');
        } catch (\Exception $e) {
            Swal::toast('Role gagal ditambahkan', 'error');
        }

        return redirect()->route('admin.role.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = $this->roleRepository->getRoleById($id);

        return view('pages.admin.account-management.role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = $this->roleRepository->getRoleById($id);
        $permissions = $this->permissionRepository->getAllPermission();

        return view('pages.admin.account-management.role.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleRequest $request, string $id)
    {
        $data = $request->validated();

        try {
            $this->roleRepository->updateRole($data, $id);

            Swal::toast('Role berhasil diupdate', 'success');
        } catch (\Exception $e) {
            Swal::toast('Role gagal diupdate', 'error');
        }

        return redirect()->route('admin.role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->roleRepository->deleteRole($id);

            Swal::toast('Role berhasil dihapus', 'success');
        } catch (\Exception $e) {
            Swal::toast('Role gagal dihapus', 'error');
        }

        return redirect()->route('admin.role.index');
    }
}
