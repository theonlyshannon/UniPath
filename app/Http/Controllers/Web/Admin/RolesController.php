<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRolesRequest;
use App\Http\Requests\UpdateRolesRequest;
use App\Interfaces\RolesRepositoryInterface;
use RealRashid\SweetAlert\Facades\Alert as Swal;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    private $roleRepository;

    private $permissionRepository;

    public function __construct(RolesRepositoryInterface $roleRepository, PermissionRepositoryInterface $permissionRepository)
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
        $roles = $this->roleRepository->getAllRoles();

        return view('pages.admin.account-managements.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = $this->permissionRepository->getAllPermission();

        return view('pages.admin.account-managements.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRolesRequest $request)
    {
        $data = $request->validated();

        try {
            $this->roleRepository->createRoles($data);

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
        $role = $this->roleRepository->getRolesById($id);

        return view('pages.admin.account-managements.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = $this->roleRepository->getRolesById($id);
        $permissions = $this->permissionRepository->getAllPermission();

        return view('pages.admin.account-managements.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRolesRequest $request, string $id)
    {
        $data = $request->validated();

        try {
            $this->roleRepository->updateRoles($data, $id);

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
            $this->roleRepository->deleteRoles($id);

            Swal::toast('Role berhasil dihapus', 'success');
        } catch (\Exception $e) {
            Swal::toast('Role gagal dihapus', 'error');
        }

        return redirect()->route('admin.role.index');
    }
}
