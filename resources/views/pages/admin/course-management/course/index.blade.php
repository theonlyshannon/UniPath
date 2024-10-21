<x-layouts.admin title="Course">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item " aria-current="page">Manajemen Kelas</li>
        <li class="breadcrumb-item active" aria-current="page">Course</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <x-ui.base-button color="primary" type="button" href="{{ route('admin.course.create') }}">
                        Tambah Kelas
                    </x-ui.base-button>
                </x-slot>
                <x-ui.datatables>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Mentor</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Thumbnail</th>
                            <th>Trailer</th>
                            <th>Aktif</th>
                            <th>Kelas Populer</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($courses as $course)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $course->mentor->name }}</td>
                                <td>{{ $course->title }}</td>
                                <td>{{ $course->slug }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}" width="100">
                                </td>
                                <td>
                                    @if ($course->trailer)
                                        <a href="https://www.youtube.com/watch?v={{ \Illuminate\Support\Str::afterLast($course->trailer, 'watch?v=') }}"
                                            target="_blank">Lihat Trailer</a>
                                    @else
                                        Tidak ada trailer
                                    @endif
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckChecked-{{ $course->id }}"
                                            {{ $course->is_active ? 'checked' : '' }}
                                            onclick="updateStatus('{{ $course->id }}', this)">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckPopular-{{ $course->id }}"
                                            {{ $course->is_popular ? 'checked' : '' }}
                                            onclick="updatePopularStatus('{{ $course->id }}', this)">
                                    </div>
                                </td>
                                <td>
                                    <x-ui.base-button color="primary" type="button"
                                        href="{{ route('admin.course.show', $course->id) }}">
                                        Detail
                                    </x-ui.base-button>
                                    @can('course-edit')
                                        <x-ui.base-button color="warning" type="button"
                                            href="{{ route('admin.course.edit', $course->id) }}">
                                            Edit
                                        </x-ui.base-button>
                                    @endcan
                                    @can('course-delete')
                                        <form action="{{ route('admin.course.destroy', $course->id) }}" method="POST"
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

    @push('plugin-scripts')
        <script>
            function updateStatus(courseId, checkbox) {
                const isActive = checkbox.checked ? 1 : 0;
                fetch(`/admin/course/${courseId}/update-status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            is_active: isActive
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Berhasil mengubah status');
                        } else {
                            checkbox.checked = !isActive;
                            alert('Gagal mengupdate status');
                        }
                    })
                    .catch(error => {
                        checkbox.checked = !isActive;
                        alert('Terjadi kesalahan');
                    });
            }
        </script>
    @endpush
</x-layouts.admin>
