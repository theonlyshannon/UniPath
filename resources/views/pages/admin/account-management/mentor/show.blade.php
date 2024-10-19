<x-layouts.admin title="Mentor">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item"><a href="{{ route('admin.mentor.index') }}">Mentor</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Detail Mentor</h6>
                </x-slot>
                <table class="table table-bordered">
                    <tr>
                        <th>Nama</th>
                        <td>{{ $mentor->name }}</td>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <td>{{ $mentor->username }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $mentor->user->email }}</td>
                    </tr>
                    <tr>
                        <th>Profile Picture</th>
                        <th>
                            <img src="{{ asset($mentor->profile_picture) }}"
                                style="max-height: 200px; object-fit: contain;">
                        </th>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <th>
                            @if ($mentor->gender == 'male')
                                Laki-laki
                            @elseif ($mentor->gender == 'female')
                                Perempuan
                            @endif
                        </th>
                    </tr>
                    <tr>
                        <th>Nomer HP</th>
                        <td>{{ $mentor->phone }}</td>
                    </tr>
                    <tr>
                        <th>Asal Kota</th>
                        <td>{{ $mentor->city }}</td>
                    </tr>
                    <tr>
                        <th>Gelar</th>
                        <td>{{ $mentor->degree }}</td>
                    </tr>
                    <tr>
                        <th>Bio</th>
                        <td>{{ $mentor->bio }}</td>
                    </tr>
                </table>
                <x-slot name="footer">
                    <x-ui.base-button color="danger" href="{{ route('admin.mentor.index') }}">Kembali</x-ui.base-button>
                </x-slot>
            </x-ui.base-card>
        </div>
    </div>
</x-layouts.admin>
