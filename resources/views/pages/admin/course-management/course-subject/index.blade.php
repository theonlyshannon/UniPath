<x-layouts.admin title="Manajemen Materi Kelas">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item" aria-current="page">Manajemen Kelas</li>
        <li class="breadcrumb-item active" aria-current="page">Materi Kelas</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <x-ui.base-button color="primary" type="button" href="{{ route('admin.course-subject.create') }}">
                        Tambah Materi
                    </x-ui.base-button>
                </x-slot>
                <x-ui.datatables>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>File Soal</th>
                            <th>Video Materi</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($courseSubjects as $courseSubject)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <!-- File Soal -->
                                <td>
                                    @if (!empty($courseSubject->subject_file))
                                        <ul>
                                            @foreach (explode(',', $courseSubject->subject_file) as $file)
                                                <li>
                                                    <a href="{{ $file }}">Lihat File</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        Tidak ada file
                                    @endif
                                </td>

                                <!-- Video Materi -->
                                <td>
                                    @if (!empty($courseSubject->subject_video))
                                        <ul>
                                            @foreach (explode(',', $courseSubject->subject_video) as $video)
                                                <li>
                                                    <a href="https://www.youtube.com/watch?v={{ \Illuminate\Support\Str::afterLast($video, 'watch?v=') }}"
                                                        target="_blank">Lihat Video</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        Tidak ada video
                                    @endif
                                </td>

                                <td>
                                    @can('course-subject-edit')
                                        <x-ui.base-button color="warning" type="button"
                                            href="{{ route('admin.course-subject.edit', $courseSubject->id) }}">
                                            Edit
                                        </x-ui.base-button>
                                    @endcan

                                    @can('course-subject-delete')
                                        <form action="{{ route('admin.course-subject.destroy', $courseSubject->id) }}"
                                            method="POST" class="d-inline">
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
