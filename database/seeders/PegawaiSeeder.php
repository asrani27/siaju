<?php

namespace Database\Seeders;

use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pegawais = [
            [
                'nip' => '198501012010011001',
                'nama' => 'Dr. Ahmad Hidayat, S.Sos., M.Si',
                'skpd' => 'Sekretariat Daerah',
                'telp' => '081234567890',
            ],
            [
                'nip' => '198602152011012001',
                'nama' => 'Dra. Siti Nurhaliza',
                'skpd' => 'Dinas Kependudukan dan Pencatatan Sipil',
                'telp' => '081234567891',
            ],
            [
                'nip' => '198703202012011001',
                'nama' => 'Budi Santoso, S.IP',
                'skpd' => 'Dinas Pemberdayaan Masyarakat dan Desa',
                'telp' => '081234567892',
            ],
            [
                'nip' => '198804052013011001',
                'nama' => 'Joko Widodo, S.Kom',
                'skpd' => 'Dinas Komunikasi dan Informatika',
                'telp' => '081234567893',
            ],
            [
                'nip' => '198905152014012001',
                'nama' => 'Rina Marlina, S.Pd., M.M.',
                'skpd' => 'Dinas Pendidikan',
                'telp' => '081234567894',
            ],
            [
                'nip' => '199001012015011001',
                'nama' => 'Hendra Wijaya, S.E.',
                'skpd' => 'Dinas Pendapatan Daerah',
                'telp' => '081234567895',
            ],
            [
                'nip' => '199102152016012001',
                'nama' => 'Maya Sari, S.Kep.,Ns',
                'skpd' => 'Dinas Kesehatan',
                'telp' => '081234567896',
            ],
            [
                'nip' => '199203202017011001',
                'nama' => 'Agus Setiawan, S.T.',
                'skpd' => 'Dinas Pekerjaan Umum dan Penataan Ruang',
                'telp' => '081234567897',
            ],
            [
                'nip' => '199304052018011001',
                'nama' => 'Dedi Kurniawan, S.H.',
                'skpd' => 'Dinas Penanaman Modal dan PTSP',
                'telp' => '081234567898',
            ],
            [
                'nip' => '199405152019012001',
                'nama' => 'Lisa Permata, S.Pt.',
                'skpd' => 'Dinas Pertanian dan Ketahanan Pangan',
                'telp' => '081234567899',
            ],
            [
                'nip' => '199501012020011001',
                'nama' => 'Fajar Nugroho, S.Psi.',
                'skpd' => 'Dinas Sosial',
                'telp' => '081234567801',
            ],
            [
                'nip' => '199602152021012001',
                'nama' => 'Wati Rahayu, S.Pd.I.',
                'skpd' => 'Kecamatan Banjarmasin Tengah',
                'telp' => '081234567802',
            ],
        ];

        foreach ($pegawais as $data) {
            // Create user dengan nip sebagai username
            $user = User::create([
                'name' => $data['nama'],
                'username' => $data['nip'],
                'email' => strtolower(str_replace(['.', ' ', ','], '', $data['nama'])) . '@siaju.go.id',
                'password' => Hash::make('siajuskppbjm'),
                'role' => 'user',
            ]);

            // Create pegawai dengan user_id
            $pegawai = Pegawai::create([
                'nip' => $data['nip'],
                'nama' => $data['nama'],
                'skpd' => $data['skpd'],
                'telp' => $data['telp'],
                'user_id' => $user->id,
            ]);
        }

        $this->command->info('12 pegawai dan user berhasil dibuat. Password: siajuskppbjm');
    }
}
