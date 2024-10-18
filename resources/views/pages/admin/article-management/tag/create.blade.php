<x-layouts.admin title="Tambah Tag Artikel">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item "><a href="{{ route('admin.article-tag.index') }}">Manajemen Artikel</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Tag Artikel</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Tambah Tag</h6>
                </x-slot>
                <form action="{{ route('admin.article-tag.store') }}" method="POST" enctype="multipart/form-data"
                    id="form">
                    @csrf

                    <x-forms.input label="Nama Tag" name="name" id="name" required />

                    <x-forms.input label="Slug" name="slug" id="slug" required />

                    <x-ui.base-button color="danger" href="{{ route('admin.article-tag.index') }}">
                        Kembali
                    </x-ui.base-button>

                    <x-ui.base-button color="primary" type="submit">
                        Tambah Tag
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
