<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Minat Anda</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<div class="container">
    <h1>Pilih Minat Anda</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('student.select-interests.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="university_main_id" class="form-label">Universitas Pilihan</label>
            <select name="university_main_id" id="university_main_id" class="form-select @error('university_main_id') is-invalid @enderror" required>
                <option value="">-- Pilih Universitas --</option>
                @foreach($universities as $university)
                    <option value="{{ $university->id }}" {{ old('university_main_id', auth()->user()->student->university_main_id ?? '') == $university->id ? 'selected' : '' }}>
                        {{ $university->name }}
                    </option>
                @endforeach
            </select>
            @error('university_main_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="university_second_id" class="form-label">Universitas Cadangan (Opsional)</label>
            <select name="university_second_id" id="university_second_id" class="form-select @error('university_second_id') is-invalid @enderror">
                <option value="">-- Pilih Universitas --</option>
                @foreach($universities as $university)
                    <option value="{{ $university->id }}" {{ old('university_second_id', auth()->user()->student->university_second_id ?? '') == $university->id ? 'selected' : '' }}>
                        {{ $university->name }}
                    </option>
                @endforeach
            </select>
            @error('university_second_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="faculty_main_id" class="form-label">Fakultas Pilihan</label>
            <select name="faculty_main_id" id="faculty_main_id" class="form-select @error('faculty_main_id') is-invalid @enderror" required>
                <option value="">-- Pilih Fakultas --</option>
                @foreach($faculties as $faculty)
                    <option value="{{ $faculty->id }}" {{ old('faculty_main_id', auth()->user()->student->faculty_main_id ?? '') == $faculty->id ? 'selected' : '' }}>
                        {{ $faculty->name }}
                    </option>
                @endforeach
            </select>
            @error('faculty_main_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="faculty_second_id" class="form-label">Fakultas Cadangan (Opsional)</label>
            <select name="faculty_second_id" id="faculty_second_id" class="form-select @error('faculty_second_id') is-invalid @enderror">
                <option value="">-- Pilih Fakultas --</option>
                @foreach($faculties as $faculty)
                    <option value="{{ $faculty->id }}" {{ old('faculty_second_id', auth()->user()->student->faculty_second_id ?? '') == $faculty->id ? 'selected' : '' }}>
                        {{ $faculty->name }}
                    </option>
                @endforeach
            </select>
            @error('faculty_second_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Nomor Telepon</label>
            <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', auth()->user()->student->phone ?? '') }}" required>
            @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', auth()->user()->student->name ?? '') }}" required>
            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Jenis Kelamin</label>
            <select name="gender" id="gender" class="form-select @error('gender') is-invalid @enderror" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="male" {{ old('gender', auth()->user()->student->gender ?? '') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                <option value="female" {{ old('gender', auth()->user()->student->gender ?? '') == 'female' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('gender')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">Kota</label>
            <input type="text" name="city" id="city" class="form-control @error('city') is-invalid @enderror" value="{{ old('city', auth()->user()->student->city ?? '') }}" required>
            @error('city')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="asal_sekolah" class="form-label">Asal Sekolah (Opsional)</label>
            <input type="text" name="asal_sekolah" id="asal_sekolah" class="form-control @error('asal_sekolah') is-invalid @enderror" value="{{ old('asal_sekolah', auth()->user()->student->asal_sekolah ?? '') }}">
            @error('asal_sekolah')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan Minat</button>
    </form>
</div>
</body>
</html>
