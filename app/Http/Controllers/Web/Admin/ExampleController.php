<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExampleRequest;
use App\Http\Requests\UpdateExampleRequest;
use App\Interfaces\ExampleRepositoryInterface;
use RealRashid\SweetAlert\Facades\Alert as Swal;
use Illuminate\Http\Request;

class ExampleController extends Controller
{
    protected $ExampleRepository;

    public function __construct(ExampleRepositoryInterface $ExampleRepository)
    {
        $this->ExampleRepository = $ExampleRepository;
    }

    public function index(Request $request)
    {
        $examples = $this->ExampleRepository->getAllExample();

        return view('pages.admin.example.index', compact('examples'));
    }

    public function create()
    {
        return view('pages.admin.example.create');
    }

    public function store(StoreExampleRequest $request)
    {
        $request->validated();

        $this->ExampleRepository->createExample($request->all());

        Swal::toast('Example created successfully!', 'success')->timerProgressBar();

        return redirect()->route('admin.example.index');
    }

    public function show($id)
    {
        $example = $this->ExampleRepository->getExampleById($id);

        return view('pages.admin.example.show', compact('example'));
    }

    public function edit($id)
    {
        $example = $this->ExampleRepository->getExampleById($id);

        return view('pages.admin.example.edit', compact('example'));
    }

    public function update(UpdateExampleRequest $request, $id)
    {
        $request->validated();

        $this->ExampleRepository->updateExample($request->all(), $id);

        Swal::toast('Example updated successfully!', 'success')->timerProgressBar();

        return redirect()->route('admin.example.index');
    }

    public function destroy($id)
    {
        $this->ExampleRepository->deleteExample($id);

        Swal::toast('Example deleted successfully!', 'success')->timerProgressBar();

        return redirect()->route('admin.example.index');
    }
}
