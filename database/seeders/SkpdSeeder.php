<?php

namespace Database\Seeders;

use App\Models\Skpd;
use Illuminate\Database\Seeder;

class SkpdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skpdData = [
            ['kode_skpd' => '1.01.0.00.0.00.01.0000', 'nama_skpd' => 'Dinas Pendidikan'],
            ['kode_skpd' => '1.03.0.00.0.00.01.0000', 'nama_skpd' => 'Dinas Pekerjaan Umum dan Penataan Ruang'],
            ['kode_skpd' => '1.04.2.10.0.00.30.0000', 'nama_skpd' => 'Dinas Perumahan Rakyat dan Kawasan Permukiman'],
            ['kode_skpd' => '1.05.0.00.0.00.01.0000', 'nama_skpd' => 'Satuan Polisi Pamong Praja'],
            ['kode_skpd' => '8.01.0.00.0.00.01.0000', 'nama_skpd' => 'Badan Kesatuan Bangsa dan Politik'],
            ['kode_skpd' => '1.06.0.00.0.00.01.0000', 'nama_skpd' => 'Dinas Sosial'],
            ['kode_skpd' => '2.08.0.00.0.00.01.0000', 'nama_skpd' => 'Dinas Pemberdayaan Perempuan dan Perlindungan Anak'],
            ['kode_skpd' => '2.09.3.27.3.25.03.0000', 'nama_skpd' => 'Dinas Ketahanan Pangan, Pertanian dan Perikanan'],
            ['kode_skpd' => '2.11.0.00.0.00.01.0000', 'nama_skpd' => 'Dinas Lingkungan Hidup'],
            ['kode_skpd' => '2.12.0.00.0.00.03.0000', 'nama_skpd' => 'Dinas Kependudukan dan Pencatatan Sipil'],
            ['kode_skpd' => '2.14.2.13.0.00.05.0000', 'nama_skpd' => 'Dinas Pengendalian Penduduk, Keluarga Berencana, dan Pemberdayaan Masyarakat'],
            ['kode_skpd' => '2.15.0.00.0.00.01.0000', 'nama_skpd' => 'Dinas Perhubungan'],
            ['kode_skpd' => '2.16.2.20.2.21.02.0000', 'nama_skpd' => 'Dinas Komunikasi, Informatika dan Statistik'],
            ['kode_skpd' => '2.17.2.07.0.00.17.0000', 'nama_skpd' => 'Dinas Cooperativa, Usaha Mikro dan Tenaga Kerja'],
            ['kode_skpd' => '2.18.0.00.0.00.23.0000', 'nama_skpd' => 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu'],
            ['kode_skpd' => '2.23.2.24.0.00.03.0000', 'nama_skpd' => 'Dinas Perpustakaan dan Kearsipan'],
            ['kode_skpd' => '3.30.3.31.0.00.08.0000', 'nama_skpd' => 'Dinas Perdagangan dan Perindustrian'],
            ['kode_skpd' => '4.01.0.00.0.00.01.0000', 'nama_skpd' => 'Sekretariat Daerah'],
            ['kode_skpd' => '4.02.0.00.0.00.01.0000', 'nama_skpd' => 'Sekretariat DPRD'],
            ['kode_skpd' => '5.02.0.00.0.00.05.0000', 'nama_skpd' => 'Badan Pengelolaan Keuangan Pendapatan dan Aset Daerah'],
            ['kode_skpd' => '6.01.0.00.0.00.01.0000', 'nama_skpd' => 'Inspektorat'],
            ['kode_skpd' => '5.03.5.04.0.00.02.0000', 'nama_skpd' => 'Badan Kepegawaian Daerah, Pendidikan dan Pelatihan'],
            ['kode_skpd' => '1.05.0.00.0.00.04.0000', 'nama_skpd' => 'Badan Penanggulangan Bencana Daerah'],
            ['kode_skpd' => '7.01.0.00.0.00.01.0000', 'nama_skpd' => 'Kecamatan Banjarmasin Timur'],
            ['kode_skpd' => '7.01.0.00.0.00.02.0000', 'nama_skpd' => 'Kecamatan Banjarmasin Utara'],
            ['kode_skpd' => '7.01.0.00.0.00.03.0000', 'nama_skpd' => 'Kecamatan Banjarmasin Tengah'],
            ['kode_skpd' => '7.01.0.00.0.00.04.0000', 'nama_skpd' => 'Kecamatan Banjarmasin Barat'],
            ['kode_skpd' => '7.01.0.00.0.00.05.0000', 'nama_skpd' => 'Kecamatan Banjarmasin Selatan'],
            ['kode_skpd' => '5.01.5.05.0.00.02.0000', 'nama_skpd' => 'Badan Perencanaan Pembangunan Daerah, Penelitian dan Pengembangan'],
            ['kode_skpd' => '1.02.0.00.0.00.01.0000', 'nama_skpd' => 'Dinas Kesehatan'],
            ['kode_skpd' => '1.05.0.00.0.00.06.0000', 'nama_skpd' => 'Dinas Pemadam Kebakaran dan Penyelamatan'],
            ['kode_skpd' => '2.22.3.26.2.19.03.0000', 'nama_skpd' => 'Dinas Kebudayaan, Kepemudaan, Olahraga dan Pariwisata'],
        ];

        foreach ($skpdData as $skpd) {
            Skpd::create($skpd);
        }
    }
}
