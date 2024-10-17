<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;
use App\Interfaces\PermissionRepositoryInterface;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class PermissionController extends Controller
{
    private $permissionRepository;

    public function __construct(PermissionRepositoryInterface $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;

        $this->middleware(['permission:permission-list|permission-create|permission-edit|permission-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:permission-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:permission-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:permission-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permissions = $this->permissionRepository->getAllPermission();

        return view('pages.admin.account-management.permission.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.account-management.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        $data = $request->validated();

        try {
            $this->permissionRepository->createPermission($data);

            Swal::toast('Permission berhasil ditambahkan', 'success');
        } catch (\Exception $e) {
            Swal::toast('Permission gagal ditambahkan', 'error');
        }

        return redirect()->route('admin.permission.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = $this->permissionRepository->getPermissionById($id);

        return view('pages.admin.account-management.permission.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionRequest $request, string $id)
    {
        $data = $request->validated();

        try {
            $this->permissionRepository->updatePermission($data, $id);

            Swal::toast('Permission berhasil diupdate', 'success');
        } catch (\Exception $e) {
            Swal::toast('Permission gagal diupdate', 'error');
        }

        return redirect()->route('admin.permission.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->permissionRepository->deletePermission($id);
        Swal::toast('Permission deleted successfully!', 'success')->timerProgressBar();
        return redirect()->route('admin.permission.index');
    }
}
