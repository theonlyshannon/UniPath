<x-layouts.admin title="Tambah Writer">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item"><a href="{{ route('admin.writer.index') }}">Writer</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Writer</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Tambah Writer</h6>
                </x-slot>
                <form action="{{ route('admin.writer.store') }}" method="POST" 
                    id="form">
                    @csrf

                    <x-forms.input label="Email" name="email" id="email" />

                    <x-forms.input label="Password" name="password" id="password" type="password" />

                    <x-forms.input label="Nama Lengkap" name="name" id="name" />

                    <x-ui.base-button color="danger" href="{{ route('admin.writer.index') }}">
                        Kembali
                    </x-ui.base-button>

                    <x-ui.base-button color="primary" type="submit">
                        Tambah Writer
                    </x-ui.base-button>
                </form>
            </x-ui.base-card>
        </div>
    </div>
</x-layouts.admin>
