<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <!-- Tambahkan link CSS SweetAlert jika diperlukan -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        /* Tambahkan beberapa styling dasar */
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .info {
            margin-bottom: 20px;
        }
        .logout-btn {
            padding: 10px 20px;
            background-color: #f44336;
            color: white;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }
        .logout-btn:hover {
            background-color: #da190b;
        }
    </style>
</head>
<body>
    <h1>Welcome, {{ auth()->user()->name }}</h1>

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

    <div class="info">
        <h2>Your Profile Information</h2>
        <p><strong>Name:</strong> {{ auth()->user()->student->name }}</p>
        <p><strong>Username:</strong> {{ auth()->user()->student->username }}</p>
        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
        <p><strong>Phone:</strong> {{ auth()->user()->student->phone ?? 'Not set' }}</p>
        <p><strong>Gender:</strong> {{ ucfirst(auth()->user()->student->gender) ?? 'Not set' }}</p>
        <p><strong>City:</strong> {{ auth()->user()->student->city ?? 'Not set' }}</p>
        <p><strong>Asal Sekolah:</strong> {{ auth()->user()->student->asal_sekolah ?? 'Not set' }}</p>
    </div>

    <div class="info">
        <h2>Your Interests</h2>
        <ul>
            <li><strong>Main University:</strong> {{ auth()->user()->student->mainUniversity->name ?? 'Not set' }}</li>
            <li><strong>Secondary University:</strong> {{ auth()->user()->student->secondUniversity->name ?? 'Not set' }}</li>
            <li><strong>Main Faculty:</strong> {{ auth()->user()->student->mainFaculty->name ?? 'Not set' }}</li>
            <li><strong>Secondary Faculty:</strong> {{ auth()->user()->student->secondFaculty->name ?? 'Not set' }}</li>
        </ul>
    </div>

    <a href="{{ route('logout') }}" class="logout-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
