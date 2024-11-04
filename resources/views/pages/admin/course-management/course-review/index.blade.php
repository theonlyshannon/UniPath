<x-layouts.admin title="Review Kelas">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item " aria-current="page">Manajemen Kelas</li>
        <li class="breadcrumb-item active" aria-current="page">Review Kelas</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <p>
                        List Review Kelas
                    </p>
                </x-slot>
                <x-ui.datatables>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Nama Siswa</th>
                            <th>Review</th>
                            <th>Status Aktif</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($reviews as $review)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $review->student->name }}</td>
                                <td>{{ $review->review }}</td>
                                <td>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckChecked-{{ $review->id }}"
                                            {{ $review->is_active ? 'checked' : '' }}
                                            onclick="updateStatusIsActive('{{ $review->id }}', this)">
                                    </div>
                                </td>
                                <td>
                                    @can('course-review-delete')
                                        <form action="{{ route('admin.course-review.destroy', $review->id) }}"
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

    @push('plugin-scripts')
        <script>
            function updateStatusIsActive(courseReviewId, checkbox) {
                const isActive = checkbox.checked ? 1 : 0;
                fetch(`/admin/course-review/${courseReviewId}/update-status`, {
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
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Berhasil mengubah status',
                            });
                        } else {
                            checkbox.checked = !isActive;
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: 'Gagal mengupdate status',
                            });
                        }
                    })
                    .catch(error => {
                        checkbox.checked = !isActive;
                        Swal.fire({
                            icon: 'error',
                            title: 'Kesalahan',
                            text: 'Terjadi kesalahan',
                        });
                    });
            }
        </script>
    @endpush
</x-layouts.admin>
