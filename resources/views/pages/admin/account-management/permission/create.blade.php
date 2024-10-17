<x-layouts.admin title="Tambah Permission">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item "><a href="{{ route('admin.permission.index') }}">Permission</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Permission</li>
    </x-ui.breadcumb-admin>
    
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Tambah Permission</h6>
                </x-slot>
                <form action="{{ route('admin.permission.store') }}" method="POST" enctype="multipart/form-data"
                    id="form">
                    @csrf

                    <x-forms.input label="Nama" name="name" id="name" placeholder="Masukkan Nama Permission"
                        value="{{ old('name') }}" />


                    <x-ui.base-button color="danger" href="{{ route('admin.permission.index') }}">
                        Kembali
                    </x-ui.base-button>

                    <x-ui.base-button color="primary" type="submit">
                        Tambah Permission
                    </x-ui.base-button>
                </form>
            </x-ui.base-card>
        </div>
    </div>
</x-layouts.admin>
