<x-layouts.admin title="Edit Writer">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item"><a href="{{ route('admin.writer.index') }}">Writer</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Writer</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Edit Writer</h6>
                </x-slot>
                <form action="{{ route('admin.writer.update', $writer->id) }}" method="POST"
                    enctype="multipart/form-data" id="form">
                    @csrf
                    @method('PUT')

                    <x-forms.input label="Email" name="email" id="email" value="{{ $writer->user->email }}"
                        disabled />

                    <x-forms.input label="Password" name="password" id="password" type="password" />

                    <x-forms.input label="Nama Lengkap" name="name" id="name" value="{{ $writer->name }}" />

                    <x-ui.base-button color="danger" href="{{ route('admin.writer.index') }}">
                        Kembali
                    </x-ui.base-button>

                    <x-ui.base-button color="primary" type="submit">
                        Update Writer
                    </x-ui.base-button>
                </form>
            </x-ui.base-card>
        </div>
    </div>

</x-layouts.admin>
