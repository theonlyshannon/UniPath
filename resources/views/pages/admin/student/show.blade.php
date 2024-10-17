
<x-layouts.admin title="Detail student">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item"><a href="{{ route('admin.student.index') }}">student</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail student</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h4 class="card-title">Detail student</h4>
                </x-slot>
                {{-- Add your detail here --}}
            </x-ui.base-card>
        </div>
    </div>
</x-layouts.admin>