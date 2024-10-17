<x-layouts.admin title="Edit Example">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item "><a href="{{ route('admin.example.index') }}">Example</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Example</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Edit Example</h6>
                </x-slot>
                <form action="{{ route('admin.example.update', $example->id) }}" method="POST" enctype="multipart/form-data"
                    id="form">
                    @csrf
                    @method('PUT')
                    <x-forms.input label="Nama" name="name" id="name" :value="$example->name" />
                    <x-forms.textarea label="Deskripsi" name="description" id="description" :value="$example->description" />
                    @php
                        $status = [
                            ['value' => 'active', 'label' => 'Aktif'],
                            ['value' => 'inactive', 'label' => 'Tidak Aktif'],
                        ];
                    @endphp
                    <x-forms.select label="Status" name="status" id="status" :options="$status" key="value" value="label"
                        :selected="$example->status" />

                    <x-ui.base-button color="danger" href="{{ route('admin.example.index') }}">
                        Kembali
                    </x-ui.base-button>

                    <x-ui.base-button color="primary" type="submit">
                        Update Example
                    </x-ui.base-button>
                </form>
            </x-ui.base-card>
        </div>
    </div>


</x-layouts.admin>
