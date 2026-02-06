<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\ApproverCategory;

class ApproverCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'nama_kategori' => 'Manager',
                'urutan' => 1,
                'deskripsi' => 'Manager UPDK',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'Asman Operasi',
                'urutan' => 2,
                'deskripsi' => 'Assistant Manager Operasi',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'Asman Pemeliharaan',
                'urutan' => 3,
                'deskripsi' => 'Assistant Manager Pemeliharaan',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'Asman Enjiniring',
                'urutan' => 4,
                'deskripsi' => 'Assistant Manager Enjiniring',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'Asman Business Support',
                'urutan' => 5,
                'deskripsi' => 'Assistant Manager Business Support',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'Team Leader Lingkungan',
                'urutan' => 6,
                'deskripsi' => 'Team Leader Lingkungan',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'Team Leader K3L',
                'urutan' => 7,
                'deskripsi' => 'Team Leader K3L',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'Team Leader Rendal OP',
                'urutan' => 8,
                'deskripsi' => 'Team Leader Rendal Operasi',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'Team Leader Bahan Bakar',
                'urutan' => 9,
                'deskripsi' => 'Team Leader Bahan Bakar',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'Team Leader Rendal HAR',
                'urutan' => 10,
                'deskripsi' => 'Team Leader Rendal HAR',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'Team Leader Outage',
                'urutan' => 11,
                'deskripsi' => 'Team Leader Outage Management',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'Team Leader Inventory dan Kontrol',
                'urutan' => 12,
                'deskripsi' => 'Team Leader Inventory dan Kontrol',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'Team Leader System Owner',
                'urutan' => 13,
                'deskripsi' => 'Team Leader System Owner',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'Team Leader CBM',
                'urutan' => 14,
                'deskripsi' => 'Team Leader Condition Based Maintenance',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'Team Leader MMRK',
                'urutan' => 15,
                'deskripsi' => 'Team Leader Manajemen Mutu Risiko Kepatuhan',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'Team Leader Pengadaan',
                'urutan' => 16,
                'deskripsi' => 'Team Leader Pengadaan',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'Team Leader SDM',
                'urutan' => 17,
                'deskripsi' => 'Team Leader SDM, Umum, dan CSR',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'Team Leader Keuangan',
                'urutan' => 18,
                'deskripsi' => 'Team Leader Keuangan',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'Manager Ketapang',
                'urutan' => 19,
                'deskripsi' => 'Manager ULPL Ketapang',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'Manager Siantan',
                'urutan' => 20,
                'deskripsi' => 'Manager ULPL Siantan',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'Manager Sei Raya',
                'urutan' => 21,
                'deskripsi' => 'Manager ULPL Sei Raya',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'Manager Sanggau Sintang',
                'urutan' => 22,
                'deskripsi' => 'Manager ULPL Sanggau dan Sintang',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'TL Operasi - Ketapang',
                'urutan' => 23,
                'deskripsi' => 'Team Leader Operasi Ketapang',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'TL Pemeliharaan - Ketapang',
                'urutan' => 24,
                'deskripsi' => 'Team Leader Pemeliharaan Ketapang',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'TL K3L - Ketapang',
                'urutan' => 25,
                'deskripsi' => 'Team Leader K3L Ketapang',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'TL Operasi - Siantan',
                'urutan' => 26,
                'deskripsi' => 'Team Leader Operasi Siantan',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'TL Pemeliharaan - Siantan',
                'urutan' => 27,
                'deskripsi' => 'Team Leader Pemeliharaan Siantan',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'TL K3L - Siantan',
                'urutan' => 28,
                'deskripsi' => 'Team Leader K3L Siantan',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'TL Operasi - Sei Raya',
                'urutan' => 29,
                'deskripsi' => 'Team Leader Operasi Sei Raya',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'TL Pemeliharaan - Sei Raya',
                'urutan' => 30,
                'deskripsi' => 'Team Leader Pemeliharaan Sei Raya',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'TL K3L - Sei Raya',
                'urutan' => 31,
                'deskripsi' => 'Team Leader K3L Sei Raya',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'TL Operasi - Sanggau Sintang',
                'urutan' => 32,
                'deskripsi' => 'Team Leader Operasi Sanggau Sintang',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'TL Pemeliharaan - Sanggau Sintang',
                'urutan' => 33,
                'deskripsi' => 'Team Leader Pemeliharaan Sanggau Sintang',
                'is_active' => true,
            ],
            [
                'nama_kategori' => 'TL K3L - Sanggau Sintang',
                'urutan' => 34,
                'deskripsi' => 'Team Leader K3L Sanggau Sintang',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            ApproverCategory::updateOrCreate(
                ['nama_kategori' => $category['nama_kategori']],
                $category
            );
        }

        ApproverCategory::query()
            ->whereNotIn('nama_kategori', array_column($categories, 'nama_kategori'))
            ->update(['is_active' => false]);
    }
}
