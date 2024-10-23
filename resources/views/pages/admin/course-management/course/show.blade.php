<x-layouts.admin title="Detail Kelas">
    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item"><a href="{{ route('admin.course.index') }}">Manajemen Kelas</a></li>
        <li class="breadcrumb-item active" aria-current="page">Detail Kelas</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Detail Kelas</h6>
                </x-slot>

                <div class="mb-3">
                    <label>Mentor</label>
                    <p>{{ $course->mentor->name }}</p>
                </div>

                <div class="mb-3">
                    <label>Kategori Kelas</label>
                    <p>{{ $course->category->name }}</p>
                </div>

                <div class="mb-3">
                    <label>Judul</label>
                    <p>{{ $course->title }}</p>
                </div>

                <div class="mb-3">
                    <label>Slug</label>
                    <p>{{ $course->slug }}</p>
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>
                    <p>{{ $course->description }}</p>
                </div>

                <div class="mb-3">
                    <label>Thumbnail</label>
                    @if($course->thumbnail)
                        <img src="{{ asset('storage/'.$course->thumbnail) }}" alt="Thumbnail Kelas" class="img-fluid" />
                    @else
                        <p>Tidak ada thumbnail</p>
                    @endif
                </div>

                <div class="mb-3">
                    <label>Trailer</label>
                    @if($course->trailer)
                        <div class="video-container mb-45" id="player">
                            <iframe width="560" height="315" src="{{ $course->trailer }}" frameborder="0" allowfullscreen></iframe>
                        </div>
                    @else
                        <p>Tidak ada trailer</p>
                    @endif
                </div>

                <div class="mb-3">
                    <label>Favourite</label>
                    <p>{{ $course->is_favourite ? 'Ya' : 'Tidak' }}</p>
                </div>

                <x-ui.base-button color="danger" href="{{ route('admin.course.index') }}">
                    Kembali
                </x-ui.base-button>

                <x-ui.base-button color="primary" href="{{ route('admin.course.edit', $course->id) }}">
                    Edit Kelas
                </x-ui.base-button>
            </x-ui.base-card>
        </div>
    </div>
</x-layouts.admin>
