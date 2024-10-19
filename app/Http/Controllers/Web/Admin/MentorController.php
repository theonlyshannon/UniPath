<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MentorStoreRequest;
use App\Http\Requests\MentorUpdateRequest;
use App\Interfaces\MentorRepositoryInterface;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class MentorController extends Controller
{
    private $mentorRepository;

    public function __construct(MentorRepositoryInterface $mentorRepository)
    {
        $this->mentorRepository = $mentorRepository;

        $this->middleware(['permission:mentor-list|mentor-create|mentor-edit|mentor-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:mentor-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:mentor-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:mentor-delete'], ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mentors = $this->mentorRepository->getAllMentor();

        return view('pages.admin.account-management.mentor.index', compact('mentors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.account-management.mentor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MentorStoreRequest $request)
    {
        try {
            $data = $request->validated();

            $this->mentorRepository->createMentor($data);

            Swal::toast('Mentor berhasil ditambahkan', 'success');
        } catch (\Exception $e) {
            Swal::toast($e->getMessage(), 'error');
        }

        return redirect()->route('admin.mentor.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mentor = $this->mentorRepository->getMentorById($id);

        return view('pages.admin.account-management.mentor.show', compact('mentor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mentor = $this->mentorRepository->getMentorById($id);

        return view('pages.admin.account-management.mentor.edit', compact('mentor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MentorUpdateRequest $request, string $id)
    {
        $data = $request->validated();

        $this->mentorRepository->updateMentor($data, $id);



        return redirect()->route('admin.mentor.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->mentorRepository->deleteMentor($id);

            Swal::toast('Mentor berhasil dihapus', 'success');
        } catch (\Exception $e) {
            Swal::toast('Mentor gagal dihapus', 'error');
        }

        return redirect()->route('admin.mentor.index');
    }
}
