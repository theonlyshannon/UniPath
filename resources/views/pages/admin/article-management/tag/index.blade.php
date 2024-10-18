<x-layouts.admin title="Tag Artikel">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item " aria-current="page">Manajemen Artikel</li>
        <li class="breadcrumb-item active" aria-current="page">Tag</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <x-ui.base-button color="primary" type="button" href="{{ route('admin.article-tag.create') }}">
                        Tambah Tag Artikel
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
                        @foreach ($tags as $tag)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $tag->name }}</td>
                                <td>{{ $tag->slug }}</td>
                                <td>
                                    @can('article-tag-edit')
                                        <x-ui.base-button color="warning" type="button"
                                            href="{{ route('admin.article-tag.edit', $tag->id) }}">
                                            Edit
                                        </x-ui.base-button>
                                    @endcan

                                    @can('article-tag-delete')
                                        <form action="{{ route('admin.article-tag.destroy', $tag->id) }}" method="POST"
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
