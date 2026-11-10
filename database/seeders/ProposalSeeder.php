<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proposal;



class ProposalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                Proposal::insert([
            [
                'id_UMKM' => 1,
                'judul' => 'Ekspansi Cabang Kuliner Sukapura',
                'deskripsi_inovasi' => 'Pembukaan cabang baru dengan konsep dapur terbuka.',
                'dana_dibutuhkan' => 75000000,
                'tanggal_pengajuan' => '2026-11-05',
                'file_proposal' => 'dummy.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_UMKM' => 2,
                'judul' => 'Mesin Pengemas Otomatis',
                'deskripsi_inovasi' => 'Pembelian mesin untuk meningkatkan kapasitas produksi.',
                'dana_dibutuhkan' => 40000000,
                'tanggal_pengajuan' => '2026-11-07',
                'file_proposal' => 'dummy.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_UMKM' => 1,
                'judul' => 'Peningkatan Kapasitas Produksi',
                'deskripsi_inovasi' => 'Investasi dalam peralatan baru untuk meningkatkan kapasitas produksi.',
                'dana_dibutuhkan' => 60000000,
                'tanggal_pengajuan' => '2026-11-10',
                'file_proposal' => 'dummy.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_UMKM' => 2,
                'judul' => 'Pemasaran Digital',
                'deskripsi_inovasi' => 'Kampanye pemasaran digital untuk meningkatkan visibilitas merek.',
                'dana_dibutuhkan' => 30000000,
                'tanggal_pengajuan' => '2026-11-12',
                'file_proposal' => 'dummy.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
