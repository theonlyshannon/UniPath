<x-layouts.admin title="Manajemen Fakultas">

    <x-ui.breadcumb-admin>
        <li class="breadcrumb-item " aria-current="page">Manajemen Universitas</li>
        <li class="breadcrumb-item active" aria-current="page">Fakultas</li>
    </x-ui.breadcumb-admin>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <x-ui.base-card>
                <x-slot name="header">
                    <x-ui.base-button color="primary" type="button" href="{{ route('admin.faculty.create') }}">
                        Tambah Fakultas
                    </x-ui.base-button>
                    <form action="{{ route('admin.faculty.scrape') }}" method="POST" class="d-flex align-items-center" id="scrape-form">
                        @csrf
                        <select name="university_id" class="form-select me-2" id="university-select" required>
                            <option value="">Pilih Universitas</option>
                            @foreach ($universities as $university)
                                <option value="{{ $university->id }}">{{ $university->name }}</option>
                            @endforeach
                        </select>
                        <x-ui.base-button color="success" type="submit" id="scrape-button" disabled>
                            Get All Faculty (Scraping)
                        </x-ui.base-button>
                    </form>
                </x-slot>
                <x-ui.datatables>
                    <x-slot name="thead">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach ($faculties as $faculty)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $faculty->name }}</td>
                                <td>
                                    @can('faculty-edit')
                                        <x-ui.base-button color="warning" type="button"
                                            href="{{ route('admin.faculty.edit', $faculty->id) }}">
                                            Edit
                                        </x-ui.base-button>
                                    @endcan

                                    @can('faculty-delete')
                                        <form action="{{ route('admin.faculty.destroy', $faculty->id) }}" method="POST"
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
    @push('custom-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const universitySelect = document.getElementById('university-select');
            const scrapeButton = document.getElementById('scrape-button');

            universitySelect.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const selectedName = selectedOption.text.trim();

                if (selectedName === 'Universitas Indonesia') {
                    scrapeButton.disabled = false;
                } else if (this.value === '') {
                    scrapeButton.disabled = true;
                } else {
                    scrapeButton.disabled = true;
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Hanya Universitas Indonesia yang dapat melakukan scraping.',
                        confirmButtonText: 'OK'
                    });
                }
            });

            // Mencegah submit form jika universitas tidak valid
            const scrapeForm = document.getElementById('scrape-form');
            scrapeForm.addEventListener('submit', function (e) {
                const selectedOption = universitySelect.options[universitySelect.selectedIndex];
                const selectedName = selectedOption.text.trim();

                if (selectedName !== 'Universitas Indonesia') {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Anda harus memilih Universitas Indonesia untuk melakukan scraping.',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });
    </script>
    @endpush
</x-layouts.admin>
