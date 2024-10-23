<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class InterestController extends Controller
{
    /**
     * Menampilkan formulir untuk memilih minat.
     */
    public function show()
    {
        $universities = \App\Models\University::all();
        $faculties = \App\Models\Faculty::all();

        return view('pages.student.select-interests', compact('universities', 'faculties'));
    }

    /**
     * Menyimpan pilihan minat mahasiswa.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'university_main' => 'required|uuid|exists:universities,id',
            'university_second' => 'nullable|uuid|exists:universities,id',
            'faculty_main' => 'required|uuid|exists:faculties,id',
            'faculty_second' => 'nullable|uuid|exists:faculties,id',
            'phone' => 'nullable|string|max:15',
            'gender' => 'nullable|in:male,female',
            'city' => 'nullable|string|max:255',
            // Tambahkan validasi untuk bidang lainnya jika diperlukan
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                             ->withErrors($validator)
                             ->withInput();
        }

        $user = Auth::user();
        $student = $user->student;

        if (!$student) {
            // Jika entri student belum ada, buat
            $student = $user->student()->create([
                'id' => (string) Str::uuid(),
                'username' => strtolower(str_replace(' ', '.', strstr($user->email, '@', true))) . rand(100, 999),
                'name' => $request->name,
                'gender' => $request->input('gender'),
                'phone' => $request->input('phone'),
                'city' => $request->input('city'),
                'university_main_id' => $request->input('university_main'),
                'university_second_id' => $request->input('university_second'),
                'faculty_main_id' => $request->input('faculty_main'),
                'faculty_second_id' => $request->input('faculty_second'),
                // Tambahkan bidang lainnya sesuai skema tabel
            ]);
        } else {
            // Update entri student jika sudah ada
            $student->update([
                'gender' => $request->input('gender'),
                'phone' => $request->input('phone'),
                'city' => $request->input('city'),
                'university_main_id' => $request->input('university_main'),
                'university_second_id' => $request->input('university_second'),
                'faculty_main_id' => $request->input('faculty_main'),
                'faculty_second_id' => $request->input('faculty_second'),
                // Tambahkan bidang lainnya sesuai skema tabel
            ]);
        }

        // Anda juga dapat menyimpan minat lainnya jika diperlukan

        return redirect()->route('student.dashboard')->with('success', 'Interests saved successfully.');
    }
}
