<x-layouts.app title="Pilih Minat Anda">
    <section class="page-header">
        <div class="container">
            <div class="page-header__content">
                <ul class="eduhive-breadcrumb list-unstyled">
                    <li><span class="eduhive-breadcrumb__icon"><i class="icon-home"></i></span><a href="{{ url('/') }}">Home</a></li>
                    <li><span>Pilih Minat Anda</span></li>
                </ul>
                <h2 class="page-header__title">Pilih Minat Anda</h2>
            </div>
        </div>
        <img src="assets/images/shapes/page-header-shape-1.png" alt="shape" class="page-header__shape-one">
        <img src="assets/images/shapes/page-header-shape-2.png" alt="shape" class="page-header__shape-two">
        <div class="page-header__shape-three"></div>
        <div class="page-header__shape-four"></div>
    </section>

    <section class="select-interests-page section-space">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="row gutter-y-50 align-items-center">
                <div class="col-lg-6 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="00ms">
                    <div class="select-interests-page__image">
                        <img src="assets/images/resources/select-interests-1.jpg" alt="select interests" class="select-interests-page__image__inner">
                    </div>
                </div>

                <div class="col-lg-6 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="100ms">
                    <form action="{{ route('student.select-interests.store') }}" method="POST">
                        @csrf
            
                        <!-- Universitas Pilihan -->
                        <div class="mb-3">
                            <x-forms.select 
                                label="Universitas Pilihan" 
                                name="university_main_id" 
                                id="university_main_id" 
                                :options="$universities" 
                                key="id" 
                                value="name" 
                                :selected="old('university_main_id', auth()->user()->student->university_main_id ?? '')" 
                                required 
                            />
                        </div>
            
                        <!-- Universitas Cadangan (Opsional) -->
                        <div class="mb-3">
                            <x-forms.select 
                                label="Universitas Cadangan (Opsional)" 
                                name="university_second_id" 
                                id="university_second_id" 
                                :options="$universities" 
                                key="id" 
                                value="name" 
                                :selected="old('university_second_id', auth()->user()->student->university_second_id ?? '')"
                            />
                        </div>
            
                        <!-- Fakultas Pilihan -->
                        <div class="mb-3">
                            <x-forms.select 
                                label="Fakultas Pilihan" 
                                name="faculty_main_id" 
                                id="faculty_main_id" 
                                :options="$faculties" 
                                key="id" 
                                value="name" 
                                :selected="old('faculty_main_id', auth()->user()->student->faculty_main_id ?? '')" 
                                required 
                            />
                        </div>
            
                        <!-- Fakultas Cadangan (Opsional) -->
                        <div class="mb-3">
                            <x-forms.select 
                                label="Fakultas Cadangan (Opsional)" 
                                name="faculty_second_id" 
                                id="faculty_second_id" 
                                :options="$faculties" 
                                key="id" 
                                value="name" 
                                :selected="old('faculty_second_id', auth()->user()->student->faculty_second_id ?? '')" 
                            />
                        </div>
            
                        <!-- Nomor Telepon -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" 
                                value="{{ old('phone', auth()->user()->student->phone ?? '') }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
            
                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" 
                                value="{{ old('name', auth()->user()->student->name ?? '') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
            
                        <div class="mb-3">
                            @php
    $genders = [
        ['value' => 'male', 'label' => 'Laki-laki'],
        ['value' => 'female', 'label' => 'Perempuan'],
        ['value' => 'other', 'label' => 'Lainnya'],
    ];
@endphp

<x-forms.select label="Jenis Kelamin" name="gender" id="gender" :options="$genders" key="value" value="label" required />
                        </div>
            
                        <!-- Kota -->
                        <div class="mb-3">
                            <label for="city" class="form-label">Kota</label>
                            <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" 
                                value="{{ old('city', auth()->user()->student->city ?? '') }}" required>
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
            
                        <!-- Asal Sekolah (Opsional) -->
                        <div class="mb-3">
                            <label for="asal_sekolah" class="form-label">Asal Sekolah (Opsional)</label>
                            <input type="text" name="asal_sekolah" id="asal_sekolah" class="form-control @error('asal_sekolah') is-invalid @enderror" 
                                value="{{ old('asal_sekolah', auth()->user()->student->asal_sekolah ?? '') }}">
                            @error('asal_sekolah')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
            
                        <!-- Tombol Submit -->
                        <button type="submit" class="btn eduhive-btn eduhive-btn--normal">Simpan Minat</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
