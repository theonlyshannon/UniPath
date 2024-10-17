<x-layouts.admin title="Tambah Example">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item "><a href="{{ route('admin.example.index') }}">Example</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Example</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Tambah Example</h6>
                </x-slot>
                <form action="{{ route('admin.example.store') }}" method="POST" enctype="multipart/form-data"
                    id="form">
                    @csrf
                    <x-forms.input label="Nama" name="name" id="name" />
                    <x-forms.textarea label="Deskripsi" name="description" id="description" />
                    @php
                        $status = [
                            ['value' => 'active', 'label' => 'Aktif'],
                            ['value' => 'inactive', 'label' => 'Tidak Aktif'],
                        ];
                    @endphp
                    <x-forms.select label="Status" name="status" id="status" :options="$status" key="value" value="label" />

                    <x-ui.base-button color="danger" href="{{ route('admin.example.index') }}">
                        Kembali
                    </x-ui.base-button>

                    <x-ui.base-button color="primary" type="submit">
                        Tambah Example
                    </x-ui.base-button>
                </form>
            </x-ui.base-card>
        </div>
    </div>


</x-layouts.admin>
