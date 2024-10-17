<x-layouts.admin title="Example">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item"><a href="{{ route('admin.example.index') }}">Example</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Detail Example</h6>
                </x-slot>
                <table class="table table-bordered">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $example->name }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $example->description }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $example->status }}</td>
                    </tr>
                </table>
                <x-slot name="footer">
                    <x-ui.base-button color="danger" href="{{ route('admin.example.index') }}">Kembali</x-ui.base-button>
                </x-slot>
            </x-ui.base-card>
        </div>
    </div>
</x-layouts.admin>
