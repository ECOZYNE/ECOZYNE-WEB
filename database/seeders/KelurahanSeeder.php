<?php

namespace Database\Seeders;

use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelurahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        $kelurahan = [
            ['id_kelurahan' => 1, 'kelurahan' => 'baloi permai', 'id_kecamatan' => 1],
            ['id_kelurahan' => 2, 'kelurahan' => 'belian', 'id_kecamatan' => 1],
            ['id_kelurahan' => 3, 'kelurahan' => 'sukajadi', 'id_kecamatan' => 1],
            ['id_kelurahan' => 4, 'kelurahan' => 'sungai panas', 'id_kecamatan' => 1],
            ['id_kelurahan' => 5, 'kelurahan' => 'taman baloi', 'id_kecamatan' => 1],
            ['id_kelurahan' => 6, 'kelurahan' => 'teluk tering', 'id_kecamatan' => 1],
            ['id_kelurahan' => 7, 'kelurahan' => 'bukit tempayan', 'id_kecamatan' => 2],
            ['id_kelurahan' => 8, 'kelurahan' => 'buliang', 'id_kecamatan' => 2],
            ['id_kelurahan' => 9, 'kelurahan' => 'kibing', 'id_kecamatan' => 2],
            ['id_kelurahan' => 10, 'kelurahan' => 'tanjung uncang', 'id_kecamatan' => 2],
            ['id_kelurahan' => 11, 'kelurahan' => 'batu merah', 'id_kecamatan' => 3],
            ['id_kelurahan' => 12, 'kelurahan' => 'kampung seraya', 'id_kecamatan' => 3],
            ['id_kelurahan' => 13, 'kelurahan' => 'sungai jodoh', 'id_kecamatan' => 3],
            ['id_kelurahan' => 14, 'kelurahan' => 'tanjung sengkuang', 'id_kecamatan' => 3],
            ['id_kelurahan' => 15, 'kelurahan' => 'kasu', 'id_kecamatan' => 4],
            ['id_kelurahan' => 16, 'kelurahan' => 'penccong', 'id_kecamatan' => 4],
            ['id_kelurahan' => 17, 'kelurahan' => 'pemping', 'id_kecamatan' => 4],
            ['id_kelurahan' => 18, 'kelurahan' => 'sekanak raya', 'id_kecamatan' => 4],
            ['id_kelurahan' => 19, 'kelurahan' => 'tanjung sari', 'id_kecamatan' => 4],
            ['id_kelurahan' => 20, 'kelurahan' => 'pulau terong', 'id_kecamatan' => 4],
            ['id_kelurahan' => 21, 'kelurahan' => 'bengkong indah', 'id_kecamatan' => 5],
            ['id_kelurahan' => 22, 'kelurahan' => 'bengkong laut', 'id_kecamatan' => 5],
            ['id_kelurahan' => 23, 'kelurahan' => 'sadai', 'id_kecamatan' => 5],
            ['id_kelurahan' => 24, 'kelurahan' => 'tanjung buntung', 'id_kecamatan' => 5],
            ['id_kelurahan' => 25, 'kelurahan' => 'batu lengong', 'id_kecamatan' => 6],
            ['id_kelurahan' => 26, 'kelurahan' => 'bulang lintang', 'id_kecamatan' => 6],
            ['id_kelurahan' => 27, 'kelurahan' => 'pantai gelam', 'id_kecamatan' => 6],
            ['id_kelurahan' => 28, 'kelurahan' => 'pulau buluh', 'id_kecamatan' => 6],
            ['id_kelurahan' => 29, 'kelurahan' => 'setokok', 'id_kecamatan' => 6],
            ['id_kelurahan' => 30, 'kelurahan' => 'temoyong', 'id_kecamatan' => 6],
            ['id_kelurahan' => 31, 'kelurahan' => 'air raja', 'id_kecamatan' => 7],
            ['id_kelurahan' => 32, 'kelurahan' => 'galang baru', 'id_kecamatan' => 7],
            ['id_kelurahan' => 33, 'kelurahan' => 'karas', 'id_kecamatan' => 7],
            ['id_kelurahan' => 34, 'kelurahan' => 'pulau abang', 'id_kecamatan' => 7],
            ['id_kelurahan' => 35, 'kelurahan' => 'rempang cate', 'id_kecamatan' => 7],
            ['id_kelurahan' => 36, 'kelurahan' => 'sembulang', 'id_kecamatan' => 7],
            ['id_kelurahan' => 37, 'kelurahan' => 'sijantung', 'id_kecamatan' => 7],
            ['id_kelurahan' => 38, 'kelurahan' => 'subung mas', 'id_kecamatan' => 7],
            ['id_kelurahan' => 39, 'kelurahan' => 'baloi indah', 'id_kecamatan' => 8],
            ['id_kelurahan' => 40, 'kelurahan' => 'batu selicin', 'id_kecamatan' => 8],
            ['id_kelurahan' => 41, 'kelurahan' => 'kampung pelita', 'id_kecamatan' => 8],
            ['id_kelurahan' => 42, 'kelurahan' => 'lubuk baja kota', 'id_kecamatan' => 8],
            ['id_kelurahan' => 43, 'kelurahan' => 'tanjung uma', 'id_kecamatan' => 8],
            ['id_kelurahan' => 44, 'kelurahan' => 'batu besar', 'id_kecamatan' => 9],
            ['id_kelurahan' => 45, 'kelurahan' => 'kabil', 'id_kecamatan' => 9],
            ['id_kelurahan' => 46, 'kelurahan' => 'ngenang', 'id_kecamatan' => 9],
            ['id_kelurahan' => 47, 'kelurahan' => 'sambau', 'id_kecamatan' => 9],
            ['id_kelurahan' => 48, 'kelurahan' => 'sagulung kota', 'id_kecamatan' => 10],
            ['id_kelurahan' => 49, 'kelurahan' => 'sungai binti', 'id_kecamatan' => 10],
            ['id_kelurahan' => 50, 'kelurahan' => 'sungai langkai', 'id_kecamatan' => 10],
            ['id_kelurahan' => 51, 'kelurahan' => 'sungai lekop', 'id_kecamatan' => 10],
            ['id_kelurahan' => 52, 'kelurahan' => 'sungai pelunggut', 'id_kecamatan' => 10],
            ['id_kelurahan' => 53, 'kelurahan' => 'tembesi', 'id_kecamatan' => 10],
            ['id_kelurahan' => 54, 'kelurahan' => 'duriangkang', 'id_kecamatan' => 11],
            ['id_kelurahan' => 55, 'kelurahan' => 'mangsang', 'id_kecamatan' => 11],
            ['id_kelurahan' => 56, 'kelurahan' => 'muka kuning', 'id_kecamatan' => 11],
            ['id_kelurahan' => 57, 'kelurahan' => 'tanjung piayu', 'id_kecamatan' => 11],
            ['id_kelurahan' => 58, 'kelurahan' => 'patam lestari', 'id_kecamatan' => 12],
            ['id_kelurahan' => 59, 'kelurahan' => 'sungai harapan', 'id_kecamatan' => 12],
            ['id_kelurahan' => 60, 'kelurahan' => 'tanjung pinggir', 'id_kecamatan' => 12],
            ['id_kelurahan' => 61, 'kelurahan' => 'tanjung riau', 'id_kecamatan' => 12],
            ['id_kelurahan' => 62, 'kelurahan' => 'tiban baru', 'id_kecamatan' => 12],
            ['id_kelurahan' => 63, 'kelurahan' => 'tiban lama', 'id_kecamatan' => 12],
            ['id_kelurahan' => 64, 'kelurahan' => 'tiban indah', 'id_kecamatan' => 12],
        ];

        foreach ($kelurahan as $data) {
            DB::table('kelurahan')->insert([
                'id_kelurahan' => $data['id_kelurahan'],
                'kelurahan' => $data['kelurahan'],
                'id_kecamatan' => $data['id_kecamatan'],
                'created_at' => Carbon::now(), // Tambahkan timestamp
                'updated_at' => Carbon::now(), // Tambahkan timestamp
            ]);
        }
    }
}
