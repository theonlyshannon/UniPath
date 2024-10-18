<x-layouts.admin title="Detail Artikel">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item"><a href="{{ route('admin.article.index') }}">Artikel</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Artikel</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h4 class="card-title">Detail article</h4>
                </x-slot>
                <table class="table table-bordered">
                    <tr>
                        <th>Title</th>
                        <td>{{ $article->title }}</td>
                    </tr>
                    <tr>
                        <th>Thumbnail</th>
                        <td>
                            <img src="{{ asset($article->thumbnail) }}" alt="{{ $article->title }}"
                                style="max-height: 200px; object-fit: contain;">
                        </td>
                    </tr>
                    <tr>
                        <th>Content</th>
                        <td style="white-space: pre-line;">
                            {!! $article->content !!}
                        </td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ $article->slug }}</td>
                    </tr>
                    <tr>
                        <th>Kategori Article</th>
                        <td>
                            @foreach ($article->categories as $category)
                                <span class="badge bg-primary">{{ $category->name }}</span><br>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>Tag Artikel</th>
                        <td>
                            @foreach ($article->tags as $tag)
                                <span class="badge bg-primary">{{ $tag->name }}</span><br>
                            @endforeach
                        </td>
                    </tr>

                    <x-slot name="footer">
                        <x-ui.base-button color="danger"
                            href="{{ route('admin.article.index') }}">Kembali</x-ui.base-button>
                    </x-slot>
                </table>
            </x-ui.base-card>
        </div>
    </div>
</x-layouts.admin>
