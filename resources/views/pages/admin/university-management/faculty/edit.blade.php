<x-layouts.admin title="Edit Fakultas">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item " aria-current="page">Manajemen Universitas</li>
        <li class="breadcrumb-item active" aria-current="page">Edit Fakultas</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Edit Fakultas</h6>
                </x-slot>
                <form action="{{ route('admin.faculty.update', $faculty->id) }}" method="POST"
                    enctype="multipart/form-data" id="form">
                    @csrf
                    @method('PUT')

                    <x-forms.input label="Nama Fakultas" name="name" id="name"
                        value="{{ $faculty->name }}" required />

                    <x-ui.base-button color="danger" href="{{ route('admin.faculty.index') }}">
                        Kembali
                    </x-ui.base-button>

                    <x-ui.base-button color="primary" type="submit">
                        Perbarui Fakultas
                    </x-ui.base-button>
                </form>
            </x-ui.base-card>
        </div>
    </div>

    @push('plugin-scripts')
        <script>
            const name = document.querySelector('#name');

            name.addEventListener('keyup', function() {
                const nameValue = name.value;
                slug.value = nameValue.toLowerCase().split(' ').join('-');
            });
        </script>
    @endpush
</x-layouts.admin>
