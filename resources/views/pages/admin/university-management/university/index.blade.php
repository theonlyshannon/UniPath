<x-layouts.admin title="Manajemen Universitas">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item " aria-current="page">Manajemen Universitas</li>
        <li class="breadcrumb-item active" aria-current="page">Universitas</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <x-ui.base-button color="primary" type="button" href="{{ route('admin.university.create') }}">
                        Tambah Universitas
                    </x-ui.base-button>
                </x-slot>
                <x-ui.datatables>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Slug</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($universities as $university)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $university->name }}</td>
                                <td>{{ $university->slug }}</td>
                                <td>
                                    @can('university-edit')
                                        <x-ui.base-button color="warning" type="button"
                                            href="{{ route('admin.university.edit', $university->id) }}">
                                            Edit
                                        </x-ui.base-button>
                                    @endcan

                                    @can('university-delete')
                                        <form action="{{ route('admin.university.destroy', $university->id) }}" method="POST"
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
