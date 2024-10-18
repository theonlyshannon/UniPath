<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WriterRequest;
use App\Interfaces\WriterRepositoryInterface;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class WriterController extends Controller
{
    private $writerRepository;

    public function __construct(WriterRepositoryInterface $writerRepository)
    {
        $this->writerRepository = $writerRepository;

        $this->middleware(['permission:writer-list|writer-create|writer-edit|writer-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:writer-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:writer-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:writer-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $writers = $this->writerRepository->getAllWriter();

        return view('pages.admin.account-management.writer.index', compact('writers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.account-management.writer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WriterRequest $request)
    {
        $data = $request->validated();

        try {
            $this->writerRepository->createWriter($data);

            Swal::toast('Writer berhasil ditambahkan', 'success');
        } catch (\Exception $e) {
            Swal::toast('Writer gagal ditambahkan', 'error');
        }

        return redirect()->route('admin.writer.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $writer = $this->writerRepository->getwriterById($id);

        return view('pages.admin.account-management.writer.show', compact('writer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $writer = $this->writerRepository->getWriterById($id);

        return view('pages.admin.account-management.writer.edit', compact('writer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(WriterRequest $request, string $id)
    {
        $data = $request->validated();

        try {
            $this->writerRepository->updateWriter($data, $id);

            Swal::toast('Writer berhasil diperbarui', 'success');
        } catch (\Exception $e) {
            Swal::toast('Writer gagal diperbarui', 'error');
        }

        return redirect()->route('admin.writer.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->writerRepository->deleteWriter($id);

            Swal::toast('Writer berhasil dihapus', 'success');
        } catch (\Exception $e) {
            Swal::toast('Writer gagal dihapus', 'error');
        }

        return redirect()->route('admin.writer.index');
    }
}
