<x-layouts.admin title="Writer">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item"><a href="{{ route('admin.writer.index') }}">Writer</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Detail Writer</h6>
                </x-slot>
                <table class="table table-bordered">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $writer->name }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{ $writer->username }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $writer->user->email }}</td>
                    </tr>
                    <tr>
                        <th>Profile Picture</th>
                        <td>{{ $writer->profile_picture }}</td>
                    </tr>

                </table>
                <x-slot name="footer">
                    <x-ui.base-button color="danger" href="{{ route('admin.writer.index') }}">Kembali</x-ui.base-button>
                </x-slot>
            </x-ui.base-card>
        </div>
    </div>
</x-layouts.admin>
