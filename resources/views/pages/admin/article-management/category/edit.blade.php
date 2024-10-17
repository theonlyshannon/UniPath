<x-layouts.admin title="Edit Kategori">
    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item "><a href="{{ route('admin.article-category.index') }}">Manajemen Artikel</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Kategori</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Edit Kategori</h6>
                </x-slot>
                <form action="{{ route('admin.article-category.update', $category->id) }}" method="POST" enctype="multipart/form-data"
                    id="form">
                    @csrf
                    @method('PUT')

                    <x-forms.input label="Nama Kategori" name="name" id="name" required value="{{ $category->name }}" />

                    <x-forms.input label="Slug" name="slug" id="slug" required value="{{ $category->slug }}" />

                    <x-ui.base-button color="danger" href="{{ route('admin.article-category.index') }}">
                        Kembali
                    </x-ui.base-button>

                    <x-ui.base-button color="primary" type="submit">
                        Update Kategori
                    </x-ui.base-button>
                </form>
            </x-ui.base-card>
        </div>
    </div>

    @push('plugin-scripts')
        <script>
            const name = document.querySelector('#name');
            const slug = document.querySelector('#slug');

            name.addEventListener('keyup', function() {
                const nameValue = name.value;
                slug.value = nameValue.toLowerCase().split(' ').join('-');
            });
        </script>
    @endpush
</x-layouts.admin>
