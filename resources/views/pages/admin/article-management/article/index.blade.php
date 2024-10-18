<x-layouts.admin title="Article">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item " aria-current="page">Manajemen Artikel</li>
        <li class="breadcrumb-item active" aria-current="page">Artikel</li>
    </x-ui.breadcumb-admin>


    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <x-ui.base-button color="primary" type="button" href="{{ route('admin.article.create') }}">
                        Tambah Article
                    </x-ui.base-button>
                </x-slot>
                <x-ui.datatables>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Writer</th>
                            <th>Kategori</th>
                            <th>Tagar</th>
                            <th>Thumbnail</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($articles as $article)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->writer->name }}</td>
                                <td>
                                    @foreach ($article->categories as $category)
                                        <span class="badge bg-primary">{{ $category->name }}</span><br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($article->tags as $tag)
                                        <span class="badge bg-primary">{{ $tag->name }}</span><br>
                                    @endforeach
                                </td>
                                <td>
                                    <img src="{{ asset($article->thumbnail) }}" alt="{{ $article->title }}"
                                        width="100">
                                </td>

                                <td>
                                    <x-ui.base-button color="primary" type="button"
                                        href="{{ route('admin.article.show', $article->id) }}">
                                        Detail
                                    </x-ui.base-button>

                                    <x-ui.base-button color="warning" type="button"
                                        href="{{ route('admin.article.edit', $article->id) }}">
                                        Edit
                                    </x-ui.base-button>

                                    <form action="{{ route('admin.article.destroy', $article->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <x-ui.base-button color="danger" type="submit"
                                            onclick="return confirm('Yakin ingin menghapus?')">
                                            Hapus
                                        </x-ui.base-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-ui.datatables>
            </x-ui.base-card>
        </div>
    </div>
</x-layouts.admin>
