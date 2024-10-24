<x-layouts.admin title="Edit Materi Kelas">
    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item" aria-current="page">Manajemen Kelas</li>
        <li class="breadcrumb-item active" aria-current="page">Edit Materi Kelas</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Edit Materi Kelas</h6>
                </x-slot>
                <form action="{{ route('admin.course-subject.update', $courseSubject->id) }}" method="POST" enctype="multipart/form-data" id="form">
                    @csrf
                    @method('PUT')

                    <p>Materi Kelas</p>
                    <button class="btn btn-primary mt-3" type="button" id="add-course-subject">+</button>

                    <div id="course-subjects" class="mb-3">
                        @if (old('course_subjects', $courseSubject->subjects))
                            @foreach (old('course_subjects', $courseSubject->subjects) as $index => $subject)
                                <div class="card mt-3" id="course-subject-{{ $index }}">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="course-subject-file-{{ $index }}" class="mb-2">File</label>
                                            @if (isset($subject['subject_file']))
                                                <p>File saat ini: <a href="{{ $subject['subject_file'] }}" target="_blank">Lihat File</a></p>
                                            @endif
                                            <input type="file" class="form-control" name="course_subjects[{{ $index }}][subject_file]" id="course-subject-file-{{ $index }}">
                                        </div>
                                        <div id="video-preview-{{ $index }}" class="mb-3">
                                            <label for="course-subject-video-{{ $index }}" class="mb-2">Link Video</label>
                                            <input type="text" class="form-control" name="course_subjects[{{ $index }}][subject_video]" id="course-subject-video-{{ $index }}" value="{{ old('course_subjects.' . $index . '.subject_video', $subject['subject_video']) }}">
                                            <div class="video-container mt-2" id="video-preview-container-{{ $index }}">
                                                <iframe width="560" height="315" src="{{ $subject['subject_video'] }}" frameborder="0" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                        <button class="btn btn-danger remove-course-subject" type="button" data-index="{{ $index }}">Hapus</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <x-ui.base-button color="danger" href="{{ route('admin.course-subject.index') }}">
                        Kembali
                    </x-ui.base-button>

                    <x-ui.base-button color="primary" type="submit">
                        Update Materi Kelas
                    </x-ui.base-button>
                </form>
            </x-ui.base-card>
        </div>
    </div>

    @push('plugin-scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const addCourseSubjectItem = (index) => {
                    const courseSubjectHtml = `
                        <div class="card mt-3" id="course-subject-${index}">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="course-subject-file-${index}" class="mb-2">File</label>
                                    <input type="file" class="form-control" name="course_subjects[${index}][subject_file]" id="course-subject-file-${index}">
                                </div>
                                <div class="mb-3">
                                    <label for="course-subject-video-${index}" class="mb-2">Link Video</label>
                                    <input type="text" class="form-control" name="course_subjects[${index}][subject_video]" id="course-subject-video-${index}">
                                </div>
                                <button class="btn btn-danger remove-course-subject" type="button" data-index="${index}">Hapus</button>
                            </div>
                        </div>`;
                    document.querySelector('#course-subjects').insertAdjacentHTML('beforeend', courseSubjectHtml);
                };

                let courseSubjectIndex = {{ count(old('course_subjects', $courseSubject->subjects ?? [])) }};

                document.querySelector('#add-course-subject').addEventListener('click', function() {
                    addCourseSubjectItem(courseSubjectIndex);
                    courseSubjectIndex++;
                });

                document.querySelector('#course-subjects').addEventListener('click', function(e) {
                    if (e.target.classList.contains('remove-course-subject')) {
                        const index = e.target.getAttribute('data-index');
                        document.querySelector(`#course-subject-${index}`).remove();
                    }
                });
            });
        </script>
    @endpush
</x-layouts.admin>
