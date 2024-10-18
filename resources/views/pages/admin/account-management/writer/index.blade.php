<x-layouts.admin title="Writer">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item " aria-current="page">Manajemen Akun</li>
        <li class="breadcrumb-item active" aria-current="page">Writer</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <x-ui.base-button color="primary" type="button" href="{{ route('admin.writer.create') }}">
                        Tambah Writer
                    </x-ui.base-button>
                </x-slot>
                <x-ui.datatables>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Jumlah Artikel</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($writers as $writer)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $writer->name }}</td>
                                <td>{{ $writer->user->email }}</td>
                                <td>-</td>
                                <td>
                                    <x-ui.base-button color="primary" type="button"
                                        href="{{ route('admin.writer.show', $writer->id) }}">
                                        Detail
                                    </x-ui.base-button>

                                    @can('writer-edit')
                                        <x-ui.base-button color="warning" type="button"
                                            href="{{ route('admin.writer.edit', $writer->id) }}">
                                            Edit
                                        </x-ui.base-button>
                                    @endcan

                                    @can('writer-delete')
                                        <form action="{{ route('admin.writer.destroy', $writer->id) }}" method="POST"
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
