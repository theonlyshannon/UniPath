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

                <table class="table table-bordered">
                    <tr>
                        <th>Mentor</th>
                        <td>{{ $course->mentor->name }}</td>
                    </tr>
                    <tr>
                        <th>Kategori Kelas</th>
                        <td>{{ $course->category->name ?? 'Tidak ada kategori' }}</td>
                    </tr>
                    <tr>
                        <th>Judul</th>
                        <td>{{ $course->title }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>{{ $course->slug }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td>{{ $course->description }}</td>
                    </tr>
                    <tr>
                        <th>Thumbnail</th>
                        <td>
                            @if ($course->thumbnail)
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="Thumbnail Kelas"
                                    class="img-fluid" />
                            @else
                                Tidak ada thumbnail
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Trailer</th>
                        <td>
                            @if ($course->trailer)
                                <div class="video-container mb-45" id="player">
                                    <iframe width="560" height="315" src="{{ $course->trailer }}" frameborder="0"
                                        allowfullscreen></iframe>
                                </div>
                            @else
                                Tidak ada trailer
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Favourite</th>
                        <td>{{ $course->is_favourite ? 'Ya' : 'Tidak' }}</td>
                    </tr>
                    <tr>
                        <th>Detail Syllabus</th>
                        <td>
                            @foreach ($course->syllabus as $syllabus)
                                <p>
                                    <strong>{{ $loop->iteration }}. {{ $syllabus->title }}</strong>
                                </p>
                            @endforeach
                        </td>
                    </tr>
                </table>

                <x-slot name="footer">
                    <x-ui.base-button color="danger"
                        href="{{ route('admin.course.index') }}">Kembali</x-ui.base-button>
                    <x-ui.base-button color="primary" href="{{ route('admin.course.edit', $course->id) }}">Edit
                        Kelas</x-ui.base-button>
                </x-slot>
            </x-ui.base-card>
        </div>
    </div>
</x-layouts.admin>
