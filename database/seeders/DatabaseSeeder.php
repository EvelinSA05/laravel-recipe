<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;
use App\Models\Resep;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'User Biasa',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user'
        ]);

        User::create([
            'name' => 'Admin User',
            'email' => 'adminuser@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        Admin::create([
            'name' => 'Admin Sistem',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password')
        ]);

        Resep::create([
            'title' => 'Nasi Goreng Spesial',
            'image' => 'nasi_goreng.jpg',
            'ingredients' => 'Nasi, Bawang Merah, Bawang Putih, Kecap, Telur',
            'step' => '1. Haluskan bumbu. 2. Tumis bumbu. 3. Masukkan nasi dan telur. 4. Aduk rata.',
            'name' => 'Chef Juna'
        ]);

        Resep::create([
            'title' => 'Ayam Bakar Madu',
            'image' => 'ayam_bakar.jpg',
            'ingredients' => 'Ayam, Madu, Kecap, Bawang Putih, Ketumbar',
            'step' => '1. Ungkep ayam. 2. Bakar dengan olesan madu. 3. Sajikan.',
            'name' => 'Chef Renatta'
        ]);
    }
}
