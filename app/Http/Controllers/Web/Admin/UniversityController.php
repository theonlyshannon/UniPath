<?php

namespace App\Http\Controllers\web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UniversityStoreRequest;
use App\Http\Requests\UniversityUpdateRequest;
use RealRashid\SweetAlert\Facades\Alert as Swal;
use App\Interfaces\UniversityRepositoryInterface;

class UniversityController extends Controller
{
    private $universityRepostory;

    public function __construct(UniversityRepositoryInterface $universityRepository)
    {
        $this->universityRepostory = $universityRepository;

        $this->middleware(['permission:university-list|university-create|university-edit|university-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:university-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:university-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:university-delete'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $universities = $this->universityRepostory->getAllUniversity();

        return view('pages.admin.university-management.university.index', compact('universities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.university-management.university.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UniversityStoreRequest $request)
    {
        $data = $request->validated();

        try {
            $this->universityRepostory->createUniversity($data);

            Swal::toast('Universitas berhasil ditambahkan', 'success');
        } catch (\Exception $e) {
            Swal::toast('Universitas gagal ditambahkan', 'error');
        }

        return redirect()->route('admin.university.index');
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
        $university = $this->universityRepostory->getUniversityById($id);

        return view('pages.admin.university-management.university.edit', compact('university'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UniversityUpdateRequest $request, string $id)
    {
        $data = $request->validated();

        try {
            $this->universityRepostory->updateUniversity($data, $id);

            Swal::toast('Universitas berhasil diperbarui', 'success');
        } catch (\Exception $e) {
            Swal::toast('Universitas gagal diperbarui', 'error');
        }

        return redirect()->route('admin.university.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->universityRepostory->deleteUniversity($id);

            Swal::toast('Universitas berhasil dihapus', 'success');
        } catch (\Exception $e) {
            Swal::toast('Universitas gagal dihapus', 'error');
        }

        return redirect()->route('admin.university.index');
    }
}
