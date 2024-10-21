<!DOCTYPE html>
<html>
<head>
    <title>Select Interests</title>
    <!-- Tambahkan link CSS SweetAlert jika diperlukan -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        /* Tambahkan beberapa styling dasar */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        select, input[type="text"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .btn-submit {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .btn-submit:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <h1>Select Your Interests</h1>

    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false,
            });
        </script>
    @endif

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('student.select-interests') }}">
        @csrf
        <div class="form-group">
            <label for="university_main">Main University <span style="color: red;">*</span></label>
            <select name="university_main" id="university_main" required>
                <option value="">-- Select Main University --</option>
                @foreach($universities as $university)
                    <option value="{{ $university->id }}" {{ old('university_main') == $university->id ? 'selected' : '' }}>
                        {{ $university->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="university_second">Secondary University</label>
            <select name="university_second" id="university_second">
                <option value="">-- Select Secondary University --</option>
                @foreach($universities as $university)
                    <option value="{{ $university->id }}" {{ old('university_second') == $university->id ? 'selected' : '' }}>
                        {{ $university->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="faculty_main">Main Faculty <span style="color: red;">*</span></label>
            <select name="faculty_main" id="faculty_main" required>
                <option value="">-- Select Main Faculty --</option>
                @foreach($faculties as $faculty)
                    <option value="{{ $faculty->id }}" {{ old('faculty_main') == $faculty->id ? 'selected' : '' }}>
                        {{ $faculty->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="faculty_second">Secondary Faculty</label>
            <select name="faculty_second" id="faculty_second">
                <option value="">-- Select Secondary Faculty --</option>
                @foreach($faculties as $faculty)
                    <option value="{{ $faculty->id }}" {{ old('faculty_second') == $faculty->id ? 'selected' : '' }}>
                        {{ $faculty->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="Enter your phone number">
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" id="gender">
                <option value="">-- Select Gender --</option>
                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div class="form-group">
            <label for="name">Full Name</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Enter your city">
        </div>

        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" id="city" value="{{ old('city') }}" placeholder="Enter your city">
        </div>

        <button type="submit" class="btn-submit">Save Interests</button>
    </form>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
