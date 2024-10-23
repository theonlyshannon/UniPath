<?php

namespace App\Repositories;

use App\Interfaces\AuthRepositoryInterface;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class AuthRepository implements AuthRepositoryInterface
{
    public function register(array $data)
    {
        DB::beginTransaction();

        $user = User::create($data);

        if ($data['role'] == 'student') {
            $user->assignRole('student');

            $username = strstr($data['email'], '@', true) . Student::count();

            $user->student()->create([
                'name' => $data['name'],
                'username' => $username,
            ]);
        }

        DB::commit();

        return $user;
    }

    public function login(array $data)
    {
        $email = $data['email'];
        $password = $data['password'];

        if (auth()->attempt(['email' => $email, 'password' => $password])) {
            if (!auth()->user()->hasRole('student')) {
                return redirect()->route('student.select-interests.show');
            }
            else {
                return redirect()->route('admin.dashboard');
            }
        }

        Swal::toast('Email atau password salah', 'error')->timerProgressBar();

        return redirect()->back();
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }

    public function user(array $data)
    {
        return auth()->user();
    }
}
