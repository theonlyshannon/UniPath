<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $counter = 1;

        $articleTitles = [
            'Panduan Masuk Universitas',
            'Memilih Jurusan Tepat',
            'Universitas Terbaik 2024',
            'Persiapan SBMPTN',
            'Beasiswa Unggulan',
            'Swasta vs Negeri',
            'Tips Belajar Efektif',
            'Beasiswa Luar Negeri',
            'Beasiswa Bidikmisi',
            'Panduan Kuliah Luar Negeri',
            'Teknik Wawancara Beasiswa',
            'Program Double Degree',
            'Rekomendasi Beasiswa Dosen',
            'Simulasi Ujian Masuk',
            'Beasiswa Penuh vs Parsial',
            'Fasilitas Penunjang Karir',
            'Tips Menulis Esai Beasiswa',
            'Portofolio Beasiswa Seni',
            'Tes Psikotes Universitas'
        ];

        $articleContents = [
            '<h5>Panduan Masuk Universitas 2024</h5><p>Mempersiapkan diri untuk masuk universitas bisa menjadi tantangan besar. Artikel ini memberikan panduan langkah demi langkah tentang bagaimana memilih universitas, menyiapkan dokumen, dan mendaftar.</p>',
            '<h5>Cara Memilih Jurusan yang Tepat</h5><p>Memilih jurusan adalah keputusan penting yang mempengaruhi masa depan karir. Dalam artikel ini, kita akan melihat beberapa tips untuk memilih jurusan yang sesuai dengan minat dan kemampuan Anda.</p>',
            '<h5>Universitas Terbaik di Indonesia 2024</h5><p>Artikel ini membahas universitas terbaik di Indonesia berdasarkan peringkat nasional dan program studi yang mereka tawarkan.</p>',
            '<h5>Langkah-langkah Persiapan SBMPTN</h5><p>SBMPTN adalah salah satu jalur masuk universitas negeri di Indonesia. Artikel ini memberikan tips dan trik untuk mempersiapkan diri menghadapi ujian tersebut.</p>',
            '<h5>Beasiswa Unggulan: Cara Mendapatkan dan Syaratnya</h5><p>Beasiswa unggulan adalah salah satu beasiswa paling kompetitif di Indonesia. Artikel ini menjelaskan cara mendaftar, syarat-syarat, dan tips agar dapat diterima.</p>',
            '<h5>Universitas Swasta vs Negeri: Perbandingan</h5><p>Artikel ini membahas perbandingan antara universitas negeri dan swasta, termasuk biaya, fasilitas, dan peluang karir yang tersedia setelah lulus.</p>',
            '<h5>Tips Belajar Efektif untuk Ujian Masuk Universitas</h5><p>Mempersiapkan ujian masuk universitas membutuhkan strategi yang baik. Artikel ini memberikan tips belajar efektif yang bisa Anda terapkan.</p>',
            '<h5>Beasiswa Luar Negeri: Peluang dan Tantangannya</h5><p>Mendapatkan beasiswa luar negeri adalah impian banyak pelajar. Artikel ini membahas peluang beasiswa internasional dan tantangan yang harus dihadapi.</p>',
            '<h5>Program Beasiswa Bidikmisi: Apa Saja yang Ditanggung?</h5><p>Bidikmisi adalah program beasiswa pemerintah yang memberikan bantuan biaya pendidikan untuk mahasiswa kurang mampu. Artikel ini menjelaskan detail apa saja yang ditanggung oleh program ini.</p>',
            '<h5>Panduan Kuliah di Luar Negeri: Dari Pendaftaran hingga Kehidupan Kampus</h5><p>Artikel ini memberikan gambaran umum tentang proses kuliah di luar negeri, mulai dari pendaftaran hingga menyesuaikan diri dengan kehidupan kampus di negara lain.</p>',
            '<h5>Teknik Wawancara Beasiswa: Cara Memaksimalkan Peluang</h5><p>Wawancara beasiswa sering kali menjadi penentu penerimaan. Artikel ini memberikan tips tentang bagaimana mempersiapkan dan menghadapi wawancara beasiswa dengan percaya diri.</p>',
            '<h5>Universitas dengan Program Double Degree di Indonesia</h5><p>Artikel ini membahas universitas-universitas di Indonesia yang menawarkan program double degree, di mana mahasiswa bisa mendapatkan dua gelar dari dua institusi berbeda.</p>',
            '<h5>Cara Mendapatkan Rekomendasi Beasiswa dari Dosen</h5><p>Rekomendasi dari dosen sangat penting dalam proses aplikasi beasiswa. Artikel ini memberikan panduan tentang cara mendapatkan rekomendasi yang baik dari dosen Anda.</p>',
            '<h5>Simulasi Ujian Masuk Universitas Terbaik</h5><p>Artikel ini memberikan panduan tentang bagaimana mengikuti simulasi ujian masuk universitas, termasuk tips untuk memaksimalkan hasil ujian simulasi.</p>',
            '<h5>Perbedaan Beasiswa Penuh dan Parsial</h5><p>Beasiswa penuh menanggung semua biaya kuliah, sementara beasiswa parsial hanya menanggung sebagian. Artikel ini membahas lebih lanjut tentang perbedaan keduanya dan bagaimana cara memilih yang terbaik.</p>',
            '<h5>Universitas dengan Fasilitas Penunjang Karir Terbaik</h5><p>Artikel ini mengeksplorasi universitas-universitas di Indonesia yang memiliki fasilitas dan layanan penunjang karir terbaik untuk membantu mahasiswa dalam dunia kerja.</p>',
            '<h5>Tips Menulis Esai untuk Beasiswa Internasional</h5><p>Esai adalah salah satu bagian terpenting dalam aplikasi beasiswa internasional. Artikel ini memberikan tips tentang cara menulis esai yang memukau dan meningkatkan peluang Anda untuk diterima.</p>',
            '<h5>Cara Membuat Portofolio untuk Beasiswa Seni dan Desain</h5><p>Bagi Anda yang ingin melamar beasiswa di bidang seni dan desain, portofolio adalah hal utama. Artikel ini memberikan panduan lengkap tentang cara membuat portofolio yang menarik.</p>',
            '<h5>Mempersiapkan Diri Menghadapi Tes Psikotes untuk Masuk Universitas</h5><p>Beberapa universitas mengharuskan calon mahasiswa mengikuti tes psikotes. Artikel ini memberikan tips tentang cara mempersiapkan diri untuk menghadapi tes tersebut.</p>'
        ];

        return [
           'thumbnail' => UploadedFile::fake()->image('thumbnail.jpg'),
            'title' => $this->faker->randomElement($articleTitles) . " #$counter", // Tambahkan counter untuk membuat unik
            'content' => $this->faker->paragraphs(3, true),
            'slug' => 'article-' . $counter++, // Pastikan slug unik dengan menambah counter
        ];
    }
}
