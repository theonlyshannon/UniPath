<?php

namespace App\Http\Controllers\Web\App;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        // Mengambil semua kursus yang aktif
        $courses = Course::where('is_active', true)->get();

        // Mengirim data ke view
        return view('pages.app.course.index', compact('courses'));
    }

    // Menampilkan detail kursus
    public function show($slug)
    {
        // Mencari kursus berdasarkan slug
        $course = Course::where('slug', $slug)->firstOrFail();

        // Mengirim data ke view
        return view('pages.app.course.detail', compact('course'));
    }

    
}
