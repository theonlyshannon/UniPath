<?php

namespace App\Repositories;

use App\Interfaces\AuthRepositoryInterface;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class AuthRepository implements AuthRepositoryInterface
{
    /**
     * Register a new user.
     *
     * This method creates a new user in the database. If the user role is 'student',
     * it assigns the role and creates a corresponding student record.
     *
     * @param array $data The data for the new user.
     * @return User The created user instance.
     */
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

    /**
     * Log in a user.
     *
     * This method attempts to log in a user with the provided email and password.
     * If successful, it redirects the user based on their role.
     *
     * @param array $data The login credentials.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(array $data)
    {
        $email = $data['email'];
        $password = $data['password'];

        if (auth()->attempt(['email' => $email, 'password' => $password])) {
            if (!auth()->user()->hasRole('student')) {
                return redirect()->route('admin.dashboard');
            }
            else {
                $student = auth()->user()->student;

                if ($this->hasSelectedInterests($student)) {
                    return redirect()->route('app.dashboard');
                }
                else {
                    return redirect()->route('student.select-interests.show');
                }
            }
        }

        Swal::toast('Email atau password salah', 'error')->timerProgressBar();
        return redirect()->back();
    }

    /**
     * Check if the student has selected interests.
     *
     * This method checks if the student has selected a university and faculty.
     *
     * @param Student $student The student instance.
     * @return bool True if interests are selected, false otherwise.
     */
    protected function hasSelectedInterests($student)
    {
        return !empty($student->university_main_id) && !empty($student->faculty_main_id);
    }

    /**
     * Log out the current user.
     *
     * This method logs out the authenticated user and redirects to the login page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }

    /**
     * Get the currently authenticated user.
     *
     * This method returns the authenticated user instance.
     *
     * @param array $data The data for the user.
     * @return User|null The authenticated user instance or null if not authenticated.
     */
    public function user(array $data)
    {
        return auth()->user();
    }
}
