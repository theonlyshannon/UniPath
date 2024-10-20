<x-layouts.admin title="Tambah Kategori Kelas">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item" aria-current="page">Manajemen Kelas</li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Kategori Kelas</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Tambah Kategori kelas</h6>
                </x-slot>
                <form action="{{ route('admin.course-category.store') }}" method="POST" enctype="multipart/form-data"
                    id="form">
                    @csrf

                    <x-forms.input label="Nama Kategori" name="name" id="name" required />

                    <x-ui.base-button color="danger" href="{{ route('admin.course-category.index') }}">
                        Kembali
                    </x-ui.base-button>

                    <x-ui.base-button color="primary" type="submit">
                        Tambah Kategori Kursus
                    </x-ui.base-button>
                </form>
            </x-ui.base-card>
        </div>
    </div>
</x-layouts.admin>
