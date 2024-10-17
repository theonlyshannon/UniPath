<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert as Swal;

class LoginController extends Controller
{
    private AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function showLoginForm()
    {
        return view('pages.auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->only('email', 'password');

        return $this->authRepository->login($data);
    }

    public function logout()
    {
        $this->authRepository->logout();

        Swal::toast('Berhasil logout', 'success')->timerProgressBar();

        return redirect()->route('login');
    }
}
