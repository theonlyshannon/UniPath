<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\University;
use App\Models\Faculty;

class DashboardController extends Controller
{
    /**
     * Menampilkan dashboard mahasiswa.
     */
    public function index()
    {
        return view('pages.student.dashboard');
    }
}
