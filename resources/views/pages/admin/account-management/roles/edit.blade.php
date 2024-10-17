
<x-layouts.admin title="Edit roles">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">roles</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit roles</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h4 class="card-title">Edit roles</h4>
                </x-slot>
                <form action="{{ route('admin.roles.update', $roles->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    {{-- Add your form here --}}
                    <x-ui.base-button color="primary" type="submit">Simpan</x-ui.base-button>
                </form>
            </x-ui.base-card>
        </div>
    </div>
</x-layouts.admin>