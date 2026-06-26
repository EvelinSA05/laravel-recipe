<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Resep;

class ResepIndonesiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reseps = [
            [
                'title' => 'Rendang Daging Sapi Khas Minang',
                'image' => 'https://images.unsplash.com/photo-1606143704849-eb181ba1543a?q=80&w=800',
                'ingredients' => '500g daging sapi, 1 liter santan kental, 2 batang serai memarkan, 3 lembar daun jeruk, 2 lembar daun kunyit, bumbu halus (bawang merah, bawang putih, cabai, jahe, lengkuas, kunyit, ketumbar).',
                'step' => '1. Potong daging. 2. Tumis bumbu halus hingga harum. 3. Masukkan santan, serai, daun jeruk, daun kunyit. 4. Masukkan daging, masak dengan api kecil hingga bumbu meresap dan mengering (sekitar 3-4 jam).',
                'name' => 'Chef Minang',
                'is_bookmarked' => 0,
                'is_approve' => 1,
            ],
            [
                'title' => 'Soto Ayam Lamongan',
                'image' => 'https://images.unsplash.com/photo-1687419950105-b1cdeb6c66bc?q=80&w=800',
                'ingredients' => '1 ekor ayam, 2 liter air, 2 batang serai, 3 lembar daun salam, koya kerupuk udang, bumbu halus (bawang merah, bawang putih, kunyit bakar, kemiri, jahe, ketumbar).',
                'step' => '1. Rebus ayam hingga empuk. 2. Tumis bumbu halus, masukkan ke rebusan ayam. 3. Angkat ayam, suwir-suwir. 4. Sajikan ayam suwir dengan soun, tauge, siram kuah panas, taburi koya.',
                'name' => 'Warung Lamongan',
                'is_bookmarked' => 0,
                'is_approve' => 1,
            ],
            [
                'title' => 'Nasi Goreng Spesial Abang-abang',
                'image' => 'https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?w=800&q=80',
                'ingredients' => '2 piring nasi putih dingin, 1 butir telur, 50g dada ayam suwir, 1 batang daun bawang, bumbu halus (3 siung bawang merah, 2 siung bawang putih, 3 cabai merah, terasi), kecap manis, garam.',
                'step' => '1. Panaskan minyak, orak-arik telur. 2. Masukkan bumbu halus, tumis hingga wangi. 3. Masukkan ayam suwir dan nasi putih. 4. Tambahkan kecap manis dan garam. 5. Aduk rata hingga matang.',
                'name' => 'Kaki Lima',
                'is_bookmarked' => 0,
                'is_approve' => 1,
            ],
            [
                'title' => 'Sate Ayam Madura Asli',
                'image' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=800&q=80',
                'ingredients' => '500g dada ayam potong dadu, tusuk sate, Bumbu kacang (200g kacang tanah goreng, 3 bawang putih goreng, 4 cabai merah goreng, gula merah, kecap manis, air jeruk limau).',
                'step' => '1. Haluskan bahan bumbu kacang. 2. Lumuri ayam dengan sedikit bumbu kacang dan kecap, lalu bakar. 3. Sajikan sate matang dengan siraman sisa bumbu kacang dan irisan bawang merah.',
                'name' => 'Cak Madura',
                'is_bookmarked' => 0,
                'is_approve' => 1,
            ],
            [
                'title' => 'Gado-Gado Betawi',
                'image' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=800&q=80',
                'ingredients' => 'Lontong, tauge rebus, bayam rebus, tahu tempe goreng, telur rebus. Bumbu (Kacang tanah goreng, gula merah, cabai rawit, terasi bakar, air asam jawa, sedikit air).',
                'step' => '1. Ulek semua bahan bumbu hingga halus dan mengental. 2. Potong-potong sayuran, tahu, tempe, dan telur. 3. Siram dengan bumbu kacang. 4. Sajikan dengan emping atau kerupuk.',
                'name' => 'Mpok Betawi',
                'is_bookmarked' => 0,
                'is_approve' => 1,
            ]
        ];

        foreach ($reseps as $resep) {
            Resep::updateOrCreate(
                ['title' => $resep['title']],
                $resep
            );
        }
    }
}
