<?php

namespace App\Http\Controllers\web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FacultyStoreRequest;
use App\Http\Requests\FacultyUpdateRequest;
use RealRashid\SweetAlert\Facades\Alert as Swal;
use App\Interfaces\FacultyRepositoryInterface;
use App\Models\Faculty;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Log;
use App\Interfaces\UniversityRepositoryInterface;

class FacultyController extends Controller
{
    private $facultyRepository;
    private $universityRepostory;

    public function __construct(FacultyRepositoryInterface $facultyRepository, UniversityRepositoryInterface $universityRepository)
    {
        $this->facultyRepository = $facultyRepository;
        $this->universityRepostory = $universityRepository;

        $this->middleware(['permission:faculty-list|faculty-create|faculty-edit|faculty-delete'], ['only' => ['index', 'store']]);
        $this->middleware(['permission:faculty-create'], ['only' => ['create', 'store']]);
        $this->middleware(['permission:faculty-edit'], ['only' => ['edit', 'update']]);
        $this->middleware(['permission:faculty-delete'], ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faculties = $this->facultyRepository->getAllFaculty();
        $universities = $this->universityRepostory->getAllUniversity();

        return view('pages.admin.university-management.faculty.index', compact('faculties', 'universities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.university-management.faculty.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FacultyStoreRequest $request)
    {
        $data = $request->validated();

        try {
            $this->facultyRepository->createFaculty($data);

            Swal::toast('Fakultas berhasil ditambahkan', 'success');
        } catch (\Exception $e) {
            Swal::toast('Fakultas gagal ditambahkan', 'error');
        }

        return redirect()->route('admin.faculty.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $faculty = $this->facultyRepository->getFacultyById($id);

        return view('pages.admin.university-management.faculty.edit', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FacultyUpdateRequest $request, string $id)
    {
        $data = $request->validated();

        try {
            $this->facultyRepository->updateFaculty($data, $id);

            Swal::toast('Fakultas berhasil diperbarui', 'success');
        } catch (\Exception $e) {
            Swal::toast('Fakultas gagal diperbarui', 'error');
        }

        return redirect()->route('admin.faculty.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->facultyRepository->deleteFaculty($id);

            Swal::toast('Fakultas berhasil dihapus', 'success');
        } catch (\Exception $e) {
            Swal::toast('Fakultas gagal dihapus', 'error');
        }

        return redirect()->route('admin.faculty.index');
    }

    /**
     * Scrape fakultas dari website quipper
     */
    public function scrape(Request $request)
    {
        // Validasi input
        $request->validate([
            'university_id' => 'required|exists:universities,id',
        ]);

        // Pastikan pengguna memiliki permission 'faculty-scrape'
        $this->authorize('faculty-scrape');

        $client = new Client();
        $url = 'https://penerimaan.ui.ac.id/ppkb/program/81';

        try {
            Log::info("Memulai scraping dari URL: $url");

            // Ambil university_id dari request
            $university_id = $request->input('university_id');
            Log::info("University ID yang dipilih: $university_id");

            // Melakukan permintaan HTTP
            $crawler = $client->request('GET', $url);

            // Cek status kode respons
            $statusCode = $client->getResponse()->getStatusCode();
            Log::info("Status code respons: $statusCode");

            if ($statusCode !== 200) {
                Log::error("Gagal mengakses halaman. Status code: $statusCode");
                return redirect()->back()->with('error', "Gagal mengakses halaman. Status code: $statusCode");
            }

            $count = 0; // Inisialisasi variabel $count

            // Seleksi elemen tabel dengan kelas 'fancy'
            $crawler->filter('table.fancy')->each(function (Crawler $table) use (&$count, $university_id) {
                $rows = $table->filter('tbody > tr');

                foreach ($rows as $row) {
                    $rowCrawler = new Crawler($row);

                    // Skip row yang tidak relevan, seperti header atau kategori
                    if ($rowCrawler->filter('td')->count() < 2) { // Minimal 2 kolom untuk 'No.' dan 'Program Studi'
                        Log::warning("Baris dengan kurang dari 2 kolom diabaikan.");
                        continue;
                    }

                    // Ekstrak data dari kolom 'Program Studi' (kolom kedua, index 1)
                    $program_studi = trim($rowCrawler->filter('td')->eq(1)->text());

                    // Cek apakah 'Program Studi' kosong atau merupakan kategori (misalnya, 'Ilmu Pengetahuan Budaya')
                    if (empty($program_studi) || preg_match('/^\d+\./', $program_studi)) {
                        Log::warning("Baris dengan 'Program Studi' kosong atau merupakan kategori diabaikan.");
                        continue;
                    }

                    // Log data yang diambil
                    Log::info("Mengambil data fakultas: Program Studi=$program_studi");

                    // Simpan ke database
                    Faculty::updateOrCreate(
                        ['name' => $program_studi, 'university_id' => $university_id],
                        [
                            'university_id' => $university_id,
                            'name' => $program_studi,
                            'description' => null, // Atur deskripsi jika diperlukan
                        ]
                    );

                    Log::info("Fakultas berhasil diproses: $program_studi");
                    $count++;
                }
            });

            Log::info("Proses scraping selesai. {$count} fakultas berhasil ditambahkan atau diperbarui.");
            Swal::toast("Proses scraping selesai. {$count} fakultas berhasil ditambahkan atau diperbarui.", 'success');

            return redirect()->back()->with('success', "Proses scraping selesai. {$count} fakultas berhasil ditambahkan atau diperbarui.");
        } catch (\Exception $e) {
            Log::error('Error scraping faculties: ' . $e->getMessage());
            Swal::toast('Terjadi kesalahan saat melakukan scraping.', 'error');
            return redirect()->back()->with('error', 'Terjadi kesalahan saat melakukan scraping.');
        }
    }
}
