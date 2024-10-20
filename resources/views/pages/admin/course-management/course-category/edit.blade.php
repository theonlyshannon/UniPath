<x-layouts.admin title="Edit Kategori Kelas">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item" aria-current="page">Manajemen Kelas</li>
        <li class="breadcrumb-item active" aria-current="page">Edit Kategori Kelas</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Edit Kategori Kelas</h6>
                </x-slot>
                <form action="{{ route('admin.course-category.update', $courseCategory->id) }}" method="POST" enctype="multipart/form-data"
                    id="form">
                    @csrf
                    @method('PUT')

                    <x-forms.input label="Nama Kategori" name="name" id="name" value="{{ $courseCategory->name }}" required />

                    <x-ui.base-button color="danger" href="{{ route('admin.course-category.index') }}">
                        Kembali
                    </x-ui.base-button>

                    <x-ui.base-button color="primary" type="submit">
                        Update Kategori Kelas
                    </x-ui.base-button>
                </form>
            </x-ui.base-card>
        </div>
    </div>
</x-layouts.admin>
