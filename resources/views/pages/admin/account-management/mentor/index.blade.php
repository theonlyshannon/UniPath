<x-layouts.admin title="Mentor">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item " aria-current="page">Manajemen Akun</li>
        <li class="breadcrumb-item active" aria-current="page">Mentor</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    @can('mentor-create')
                        <x-ui.base-button color="primary" type="button" href="{{ route('admin.mentor.create') }}">
                            Tambah Mentor
                        </x-ui.base-button>
                    @endcan
                </x-slot>
                <x-ui.datatables>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Gelar</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($mentors as $mentor)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $mentor->name }}</td>
                                <td>{{ $mentor->user->email }}</td>
                                <td>{{ $mentor->degree }}</td>
                                <td>
                                    <x-ui.base-button color="primary" type="button"
                                        href="{{ route('admin.mentor.show', $mentor->id) }}">
                                        Detail
                                    </x-ui.base-button>

                                    @can('mentor-edit')
                                        <x-ui.base-button color="warning" type="button"
                                            href="{{ route('admin.mentor.edit', $mentor->id) }}">
                                            Edit
                                        </x-ui.base-button>
                                    @endcan

                                    @can('mentor-delete')
                                        <form action="{{ route('admin.mentor.destroy', $mentor->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-ui.base-button color="danger" type="submit"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                                Hapus
                                            </x-ui.base-button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-ui.datatables>
            </x-ui.base-card>
        </div>
    </div>
</x-layouts.admin>
