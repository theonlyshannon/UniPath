<x-layouts.admin title="Tambah Materi Kelas">
    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item" aria-current="page">Manajemen Kelas</li>
        <li class="breadcrumb-item active" aria-current="page">Tambah Materi Kelas</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <h6>Tambah Materi Kelas</h6>
                </x-slot>
                <form action="{{ route('admin.course-subject.store') }}" method="POST" enctype="multipart/form-data"
                    id="form">
                    @csrf

                    <p>Materi Kelas</p>
                    <button class="btn btn-primary mt-3" type="button" id="add-course-subject">+</button>

                    <div id="course-subjects" class="mb-3">
                        @if (old('course_subject'))
                            @foreach (old('course_subject') as $index => $courseSubject)
                                <div class="card mt-3" id="course-subject-{{ $index }}">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="course-subject-file-{{ $index }}"
                                                class="mb-2">File</label>
                                            <input type="file" class="form-control"
                                                name="course_subjects[{{ $index }}][subject_file]"
                                                id="course-subject-file-{{ $index }}">
                                        </div>
                                        <div id="video-preview-{{ $index }}" class="mb-3"
                                            style="display: none;">
                                            <label for="video-preview">Preview Video</label>

                                            <div class="video-container mb-45" id="player-{{ $index }}">
                                                <iframe width="560" height="315" src="" frameborder="0"
                                                    allowfullscreen id="video-iframe-{{ $index }}"></iframe>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="course-subject-video-{{ $index }}" class="mb-2">Link
                                                Video</label>
                                            <input type="text" class="form-control"
                                                name="course_subjects[{{ $index }}][subject_video]"
                                                id="course-subject-video-{{ $index }}"
                                                value="{{ $courseSubject['subject_video'] }}">
                                        </div>
                                        <button class="btn btn-danger remove-course-subject" type="button"
                                            data-index="{{ $index }}">Hapus</button>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <x-ui.base-button color="danger" href="{{ route('admin.course-subject.index') }}">
                        Kembali
                    </x-ui.base-button>

                    <x-ui.base-button color="primary" type="submit">
                        Tambah Materi Kelas
                    </x-ui.base-button>
                </form>
            </x-ui.base-card>
        </div>
    </div>

    @push('plugin-scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const extractYouTubeId = (url) => {
                    if (url.includes('youtu.be/')) {
                        return url.split('youtu.be/')[1].split(/[?&]/)[0];
                    } else if (url.includes('youtube.com/watch?v=')) {
                        return url.split('youtube.com/watch?v=')[1].split(/[?&]/)[0];
                    }
                    return '';
                };

                const updateVideoPreview = (index, youtubeId) => {
                    const iframe = document.querySelector(`#video-iframe-${index}`);
                    const videoPreview = document.querySelector(`#video-preview-${index}`);

                    if (youtubeId) {
                        iframe.src = `https://www.youtube.com/embed/${youtubeId}`;
                        videoPreview.style.display = 'block';
                    } else {
                        iframe.src = '';
                        videoPreview.style.display = 'none';
                    }
                };

                const addCourseSubjectItem = (index) => {
                    const courseSubjectHtml = `
                        <div class="card mt-3" id="course-subject-${index}">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="course-subject-file-${index}" class="mb-2">File</label>
                                    <input type="file" class="form-control" name="course_subjects[${index}][subject_file]" id="course-subject-file-${index}">
                                </div>
                                <div id="video-preview-${index}" class="mb-3" style="display: none;">
                                    <label for="video-preview">Preview Video</label>
                                    <div class="video-container mb-45" id="player-${index}">
                                        <iframe width="560" height="315" src="" frameborder="0" allowfullscreen id="video-iframe-${index}"></iframe>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="course-subject-video-${index}" class="mb-2">Link Video</label>
                                    <input type="text" class="form-control" name="course_subjects[${index}][subject_video]" id="course-subject-video-${index}">
                                </div>
                                <button class="btn btn-danger remove-course-subject" type="button" data-index="${index}">Hapus</button>
                            </div>
                        </div>`;
                    document.querySelector('#course-subjects').insertAdjacentHTML('beforeend', courseSubjectHtml);

                    document.querySelector(`#course-subject-video-${index}`).addEventListener('input', function() {
                        const youtubeId = extractYouTubeId(this.value);
                        updateVideoPreview(index, youtubeId);
                    });
                };

                let courseSubjectIndex = {{ count(old('course_subjects', [])) }};

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

                const existingVideos = document.querySelectorAll('input[id^="course-subject-video-"]');
                existingVideos.forEach((input, index) => {
                    input.addEventListener('input', function() {
                        const youtubeId = extractYouTubeId(input.value);
                        updateVideoPreview(index, youtubeId);
                    });
                });
            });
        </script>
    @endpush
</x-layouts.admin>
