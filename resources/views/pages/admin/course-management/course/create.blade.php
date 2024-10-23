<x-layouts.admin title="Tambah Kelas">
    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item"><a href="{{ route('admin.course.index') }}">Manajemen Kelas</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Kelas</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Tambah Kelas</h6>
                </x-slot>
                <form action="{{ route('admin.course.store') }}" method="POST" enctype="multipart/form-data"
                    id="form">
                    @csrf

                    <x-forms.select label="Mentor" name="mentor_id" id="mentor_id" :options="$mentors" key="id"
                        value="name" :selected="old('mentor_id')" />

                    <x-forms.select label="Kategori Kelas" name="course_category_id" id="course_category_id"
                        :options="$categories" key="id" value="name" :selected="old('course_category_id')" />

                    <x-forms.input label="Judul" name="title" id="title" value="{{ old('title') }}" />

                    <x-forms.input label="Slug" name="slug" id="slug" value="{{ old('slug') }}" />

                    <x-forms.textarea label="Deskripsi" name="description" id="description">
                        {{ old('description') }}
                    </x-forms.textarea>

                    <img id="thumbnail-preview" src="#" alt="Thumbnail Preview"
                        style="display:none; max-width: 500px; margin-top: 10px; margin-bottom: 10px;" />

                    <x-forms.input label="Thumbnail" name="thumbnail" id="thumbnail" type="file"
                        value="{{ old('thumbnail') }}" />

                    <x-forms.input label="Trailer" name="trailer" id="trailer" value="{{ old('trailer') }}" />

                    <div id="trailer-preview" class="mb-3" style="display: none;">
                        <label for="trailer-preview">Preview Trailer</label>

                        <div class="video-container mb-45" id="player">
                            <iframe width="560" height="315" src="" frameborder="0" allowfullscreen
                                id="trailer-iframe"></iframe>
                        </div>
                    </div>

                    <div class="mb-3">
                        <input type="hidden" name="is_favourite" value="0">
                        <x-forms.checkbox label="Kelas Favourite" id="is_favourite" name="is_favourite"
                            :checked="old('is_favourite')" />
                    </div>

                    <x-ui.base-button color="danger" href="{{ route('admin.course.index') }}">
                        Kembali
                    </x-ui.base-button>

                    <x-ui.base-button color="primary" type="submit">
                        Tambah Kelas
                    </x-ui.base-button>
                </form>
            </x-ui.base-card>
        </div>
    </div>

    @push('plugin-scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const elements = {
                    title: document.querySelector('#title'),
                    slug: document.querySelector('#slug'),
                    trailer: document.querySelector('#trailer'),
                    trailerPreview: document.querySelector('#trailer-preview'),
                    trailerIframe: document.querySelector('#trailer-iframe'),
                    thumbnail: document.querySelector('#thumbnail'),
                    thumbnailPreview: document.querySelector('#thumbnail-preview'),
                };

                const createSlug = (text) => {
                    return text.trim().toLowerCase().split(' ').join('-');
                };

                const extractYouTubeId = (url) => {
                    if (url.includes('youtu.be/')) {
                        return url.split('youtu.be/')[1].split(/[?&]/)[0];
                    } else if (url.includes('youtube.com/watch?v=')) {
                        return url.split('youtube.com/watch?v=')[1].split(/[?&]/)[0];
                    }
                    return '';
                };

                const updateTrailerPreview = (youtubeId) => {
                    if (youtubeId) {
                        elements.trailerIframe.src = `https://www.youtube.com/embed/${youtubeId}`;
                        elements.trailerPreview.style.display = 'block';
                        elements.trailer.value = `https://www.youtube.com/embed/${youtubeId}`;
                    } else {
                        elements.trailerIframe.src = '';
                        elements.trailerPreview.style.display = 'none';
                    }
                };

                const updateThumbnailPreview = (file) => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        elements.thumbnailPreview.src = e.target.result;
                        elements.thumbnailPreview.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                };

                elements.title.addEventListener('keyup', function() {
                    elements.slug.value = createSlug(elements.title.value);
                });

                elements.trailer.addEventListener('input', function() {
                    const youtubeId = extractYouTubeId(elements.trailer.value);
                    updateTrailerPreview(youtubeId);
                });

                elements.thumbnail.addEventListener('change', function(e) {
                    const file = e.target.files[0];
                    if (file) {
                        updateThumbnailPreview(file);
                    } else {
                        elements.thumbnailPreview.src = '';
                        elements.thumbnailPreview.style.display = 'none';
                    }
                });
            });
        </script>

        <script>
            $('#is_favourite').change(function() {
                $(this).val(this.checked ? 1 : 0);
            });
        </script>
    @endpush
</x-layouts.admin>
