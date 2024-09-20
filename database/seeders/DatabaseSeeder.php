<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Dosen;
use App\Models\Kategori;
use App\Models\SubcategoryRelation;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        $relations = [
            // Baris 1 - Komputer
            ['subcategory1_id' => 1, 'subcategory2_id' => 1, 'score' => 5],
            ['subcategory1_id' => 1, 'subcategory2_id' => 2, 'score' => 1],
            ['subcategory1_id' => 1, 'subcategory2_id' => 3, 'score' => 3],
            ['subcategory1_id' => 1, 'subcategory2_id' => 4, 'score' => 3],
            ['subcategory1_id' => 1, 'subcategory2_id' => 5, 'score' => 3],
            ['subcategory1_id' => 1, 'subcategory2_id' => 6, 'score' => 2],
            ['subcategory1_id' => 1, 'subcategory2_id' => 7, 'score' => 4],
            ['subcategory1_id' => 1, 'subcategory2_id' => 8, 'score' => 3],
            ['subcategory1_id' => 1, 'subcategory2_id' => 9, 'score' => 4],
            ['subcategory1_id' => 1, 'subcategory2_id' => 10, 'score' => 2],

            // Baris 2 - E-government
            ['subcategory1_id' => 2, 'subcategory2_id' => 1, 'score' => 3],
            ['subcategory1_id' => 2, 'subcategory2_id' => 2, 'score' => 5],
            ['subcategory1_id' => 2, 'subcategory2_id' => 3, 'score' => 2],
            ['subcategory1_id' => 2, 'subcategory2_id' => 4, 'score' => 4],
            ['subcategory1_id' => 2, 'subcategory2_id' => 5, 'score' => 2],
            ['subcategory1_id' => 2, 'subcategory2_id' => 6, 'score' => 1],
            ['subcategory1_id' => 2, 'subcategory2_id' => 7, 'score' => 1],
            ['subcategory1_id' => 2, 'subcategory2_id' => 8, 'score' => 3],
            ['subcategory1_id' => 2, 'subcategory2_id' => 9, 'score' => 4],
            ['subcategory1_id' => 2, 'subcategory2_id' => 10, 'score' => 1],

            // Baris 3 - Web programming
            ['subcategory1_id' => 3, 'subcategory2_id' => 1, 'score' => 3],
            ['subcategory1_id' => 3, 'subcategory2_id' => 2, 'score' => 2],
            ['subcategory1_id' => 3, 'subcategory2_id' => 3, 'score' => 5],
            ['subcategory1_id' => 3, 'subcategory2_id' => 4, 'score' => 3],
            ['subcategory1_id' => 3, 'subcategory2_id' => 5, 'score' => 4],
            ['subcategory1_id' => 3, 'subcategory2_id' => 6, 'score' => 2],
            ['subcategory1_id' => 3, 'subcategory2_id' => 7, 'score' => 1],
            ['subcategory1_id' => 3, 'subcategory2_id' => 8, 'score' => 3],
            ['subcategory1_id' => 3, 'subcategory2_id' => 9, 'score' => 4],
            ['subcategory1_id' => 3, 'subcategory2_id' => 10, 'score' => 4],

            // Baris 4 - Sistem pendukung keputusan
            ['subcategory1_id' => 4, 'subcategory2_id' => 1, 'score' => 3],
            ['subcategory1_id' => 4, 'subcategory2_id' => 2, 'score' => 2],
            ['subcategory1_id' => 4, 'subcategory2_id' => 3, 'score' => 3],
            ['subcategory1_id' => 4, 'subcategory2_id' => 4, 'score' => 5],
            ['subcategory1_id' => 4, 'subcategory2_id' => 5, 'score' => 2],
            ['subcategory1_id' => 4, 'subcategory2_id' => 6, 'score' => 1],
            ['subcategory1_id' => 4, 'subcategory2_id' => 7, 'score' => 2],
            ['subcategory1_id' => 4, 'subcategory2_id' => 8, 'score' => 3],
            ['subcategory1_id' => 4, 'subcategory2_id' => 9, 'score' => 4],
            ['subcategory1_id' => 4, 'subcategory2_id' => 10, 'score' => 3],

            // Baris 5 - Multimedia
            ['subcategory1_id' => 5, 'subcategory2_id' => 1, 'score' => 3],
            ['subcategory1_id' => 5, 'subcategory2_id' => 2, 'score' => 2],
            ['subcategory1_id' => 5, 'subcategory2_id' => 3, 'score' => 4],
            ['subcategory1_id' => 5, 'subcategory2_id' => 4, 'score' => 2],
            ['subcategory1_id' => 5, 'subcategory2_id' => 5, 'score' => 5],
            ['subcategory1_id' => 5, 'subcategory2_id' => 6, 'score' => 1],
            ['subcategory1_id' => 5, 'subcategory2_id' => 7, 'score' => 3],
            ['subcategory1_id' => 5, 'subcategory2_id' => 8, 'score' => 3],
            ['subcategory1_id' => 5, 'subcategory2_id' => 9, 'score' => 1],
            ['subcategory1_id' => 5, 'subcategory2_id' => 10, 'score' => 3],

            // Baris 6 - Embedded system
            ['subcategory1_id' => 6, 'subcategory2_id' => 1, 'score' => 2],
            ['subcategory1_id' => 6, 'subcategory2_id' => 2, 'score' => 1],
            ['subcategory1_id' => 6, 'subcategory2_id' => 3, 'score' => 3],
            ['subcategory1_id' => 6, 'subcategory2_id' => 4, 'score' => 1],
            ['subcategory1_id' => 6, 'subcategory2_id' => 5, 'score' => 1],
            ['subcategory1_id' => 6, 'subcategory2_id' => 6, 'score' => 5],
            ['subcategory1_id' => 6, 'subcategory2_id' => 7, 'score' => 3],
            ['subcategory1_id' => 6, 'subcategory2_id' => 8, 'score' => 3],
            ['subcategory1_id' => 6, 'subcategory2_id' => 9, 'score' => 4],
            ['subcategory1_id' => 6, 'subcategory2_id' => 10, 'score' => 4],

            // Baris 7 - Pemrograman
            ['subcategory1_id' => 7, 'subcategory2_id' => 1, 'score' => 3],
            ['subcategory1_id' => 7, 'subcategory2_id' => 2, 'score' => 1],
            ['subcategory1_id' => 7, 'subcategory2_id' => 3, 'score' => 1],
            ['subcategory1_id' => 7, 'subcategory2_id' => 4, 'score' => 3],
            ['subcategory1_id' => 7, 'subcategory2_id' => 5, 'score' => 3],
            ['subcategory1_id' => 7, 'subcategory2_id' => 6, 'score' => 1],
            ['subcategory1_id' => 7, 'subcategory2_id' => 7, 'score' => 5],
            ['subcategory1_id' => 7, 'subcategory2_id' => 8, 'score' => 4],
            ['subcategory1_id' => 7, 'subcategory2_id' => 9, 'score' => 3],
            ['subcategory1_id' => 7, 'subcategory2_id' => 10, 'score' => 4],

            // Baris 8 - Manajemen telekomunikasi
            ['subcategory1_id' => 8, 'subcategory2_id' => 1, 'score' => 4],
            ['subcategory1_id' => 8, 'subcategory2_id' => 2, 'score' => 1],
            ['subcategory1_id' => 8, 'subcategory2_id' => 3, 'score' => 3],
            ['subcategory1_id' => 8, 'subcategory2_id' => 4, 'score' => 2],
            ['subcategory1_id' => 8, 'subcategory2_id' => 5, 'score' => 1],
            ['subcategory1_id' => 8, 'subcategory2_id' => 6, 'score' => 3],
            ['subcategory1_id' => 8, 'subcategory2_id' => 7, 'score' => 4],
            ['subcategory1_id' => 8, 'subcategory2_id' => 8, 'score' => 4],
            ['subcategory1_id' => 8, 'subcategory2_id' => 9, 'score' => 2],
            ['subcategory1_id' => 8, 'subcategory2_id' => 10, 'score' => 5],

            // Baris 9 - Teknik informatika
            ['subcategory1_id' => 9, 'subcategory2_id' => 1, 'score' => 4],
            ['subcategory1_id' => 9, 'subcategory2_id' => 2, 'score' => 1],
            ['subcategory1_id' => 9, 'subcategory2_id' => 3, 'score' => 3],
            ['subcategory1_id' => 9, 'subcategory2_id' => 4, 'score' => 4],
            ['subcategory1_id' => 9, 'subcategory2_id' => 5, 'score' => 2],
            ['subcategory1_id' => 9, 'subcategory2_id' => 6, 'score' => 4],
            ['subcategory1_id' => 9, 'subcategory2_id' => 7, 'score' => 5],
            ['subcategory1_id' => 9, 'subcategory2_id' => 8, 'score' => 3],
            ['subcategory1_id' => 9, 'subcategory2_id' => 9, 'score' => 2],
            ['subcategory1_id' => 9, 'subcategory2_id' => 10, 'score' => 5],

            // Baris 10 - Sistem informasi
            ['subcategory1_id' => 10, 'subcategory2_id' => 1, 'score' => 2],
            ['subcategory1_id' => 10, 'subcategory2_id' => 2, 'score' => 1],
            ['subcategory1_id' => 10, 'subcategory2_id' => 3, 'score' => 4],
            ['subcategory1_id' => 10, 'subcategory2_id' => 4, 'score' => 3],
            ['subcategory1_id' => 10, 'subcategory2_id' => 5, 'score' => 3],
            ['subcategory1_id' => 10, 'subcategory2_id' => 6, 'score' => 4],
            ['subcategory1_id' => 10, 'subcategory2_id' => 7, 'score' => 4],
            ['subcategory1_id' => 10, 'subcategory2_id' => 8, 'score' => 4],
            ['subcategory1_id' => 10, 'subcategory2_id' => 9, 'score' => 2],
            ['subcategory1_id' => 10, 'subcategory2_id' => 10, 'score' => 5],

            // Kategori 2
            ['subcategory1_id' => 11, 'subcategory2_id' => 11, 'score' => 5],
            ['subcategory1_id' => 11, 'subcategory2_id' => 12, 'score' => 1],
            ['subcategory1_id' => 11, 'subcategory2_id' => 13, 'score' => 4],
            ['subcategory1_id' => 11, 'subcategory2_id' => 14, 'score' => 3],
            ['subcategory1_id' => 11, 'subcategory2_id' => 15, 'score' => 3],
            ['subcategory1_id' => 11, 'subcategory2_id' => 16, 'score' => 4],
            ['subcategory1_id' => 11, 'subcategory2_id' => 17, 'score' => 4],
            ['subcategory1_id' => 11, 'subcategory2_id' => 18, 'score' => 4],
            ['subcategory1_id' => 11, 'subcategory2_id' => 19, 'score' => 4],
            ['subcategory1_id' => 11, 'subcategory2_id' => 20, 'score' => 4],
            ['subcategory1_id' => 11, 'subcategory2_id' => 21, 'score' => 2],
            ['subcategory1_id' => 11, 'subcategory2_id' => 22, 'score' => 3],
            ['subcategory1_id' => 11, 'subcategory2_id' => 23, 'score' => 2],
            ['subcategory1_id' => 11, 'subcategory2_id' => 24, 'score' => 3],
            ['subcategory1_id' => 11, 'subcategory2_id' => 25, 'score' => 4],
            ['subcategory1_id' => 11, 'subcategory2_id' => 26, 'score' => 4],
            ['subcategory1_id' => 11, 'subcategory2_id' => 27, 'score' => 3],
            ['subcategory1_id' => 11, 'subcategory2_id' => 28, 'score' => 2],
            ['subcategory1_id' => 11, 'subcategory2_id' => 29, 'score' => 3],
            ['subcategory1_id' => 11, 'subcategory2_id' => 30, 'score' => 3],
            ['subcategory1_id' => 11, 'subcategory2_id' => 31, 'score' => 4],
            ['subcategory1_id' => 11, 'subcategory2_id' => 32, 'score' => 3],
            ['subcategory1_id' => 11, 'subcategory2_id' => 33, 'score' => 3],
            ['subcategory1_id' => 11, 'subcategory2_id' => 34, 'score' => 2],

            // Baris 2 - E-commerce
            ['subcategory1_id' => 12, 'subcategory2_id' => 11, 'score' => 1],
            ['subcategory1_id' => 12, 'subcategory2_id' => 12, 'score' => 5],
            ['subcategory1_id' => 12, 'subcategory2_id' => 13, 'score' => 3],
            ['subcategory1_id' => 12, 'subcategory2_id' => 14, 'score' => 4],
            ['subcategory1_id' => 12, 'subcategory2_id' => 15, 'score' => 2],
            ['subcategory1_id' => 12, 'subcategory2_id' => 16, 'score' => 3],
            ['subcategory1_id' => 12, 'subcategory2_id' => 17, 'score' => 4],
            ['subcategory1_id' => 12, 'subcategory2_id' => 18, 'score' => 4],
            ['subcategory1_id' => 12, 'subcategory2_id' => 19, 'score' => 4],
            ['subcategory1_id' => 12, 'subcategory2_id' => 20, 'score' => 4],
            ['subcategory1_id' => 12, 'subcategory2_id' => 21, 'score' => 2],
            ['subcategory1_id' => 12, 'subcategory2_id' => 22, 'score' => 3],
            ['subcategory1_id' => 12, 'subcategory2_id' => 23, 'score' => 2],
            ['subcategory1_id' => 12, 'subcategory2_id' => 24, 'score' => 3],
            ['subcategory1_id' => 12, 'subcategory2_id' => 25, 'score' => 4],
            ['subcategory1_id' => 12, 'subcategory2_id' => 26, 'score' => 4],
            ['subcategory1_id' => 12, 'subcategory2_id' => 27, 'score' => 3],
            ['subcategory1_id' => 12, 'subcategory2_id' => 28, 'score' => 2],
            ['subcategory1_id' => 12, 'subcategory2_id' => 29, 'score' => 3],
            ['subcategory1_id' => 12, 'subcategory2_id' => 30, 'score' => 3],
            ['subcategory1_id' => 12, 'subcategory2_id' => 31, 'score' => 4],
            ['subcategory1_id' => 12, 'subcategory2_id' => 32, 'score' => 3],
            ['subcategory1_id' => 12, 'subcategory2_id' => 33, 'score' => 3],
            ['subcategory1_id' => 12, 'subcategory2_id' => 34, 'score' => 2],

            // Baris 3 - Data mining
            ['subcategory1_id' => 13, 'subcategory2_id' => 11, 'score' => 4],
            ['subcategory1_id' => 13, 'subcategory2_id' => 12, 'score' => 3],
            ['subcategory1_id' => 13, 'subcategory2_id' => 13, 'score' => 5],
            ['subcategory1_id' => 13, 'subcategory2_id' => 14, 'score' => 4],
            ['subcategory1_id' => 13, 'subcategory2_id' => 15, 'score' => 3],
            ['subcategory1_id' => 13, 'subcategory2_id' => 16, 'score' => 4],
            ['subcategory1_id' => 13, 'subcategory2_id' => 17, 'score' => 4],
            ['subcategory1_id' => 13, 'subcategory2_id' => 18, 'score' => 4],
            ['subcategory1_id' => 13, 'subcategory2_id' => 19, 'score' => 4],
            ['subcategory1_id' => 13, 'subcategory2_id' => 20, 'score' => 4],
            ['subcategory1_id' => 13, 'subcategory2_id' => 21, 'score' => 2],
            ['subcategory1_id' => 13, 'subcategory2_id' => 22, 'score' => 3],
            ['subcategory1_id' => 13, 'subcategory2_id' => 23, 'score' => 2],
            ['subcategory1_id' => 13, 'subcategory2_id' => 24, 'score' => 3],
            ['subcategory1_id' => 13, 'subcategory2_id' => 25, 'score' => 4],
            ['subcategory1_id' => 13, 'subcategory2_id' => 26, 'score' => 4],
            ['subcategory1_id' => 13, 'subcategory2_id' => 27, 'score' => 3],
            ['subcategory1_id' => 13, 'subcategory2_id' => 28, 'score' => 2],
            ['subcategory1_id' => 13, 'subcategory2_id' => 29, 'score' => 3],
            ['subcategory1_id' => 13, 'subcategory2_id' => 30, 'score' => 3],
            ['subcategory1_id' => 13, 'subcategory2_id' => 31, 'score' => 4],
            ['subcategory1_id' => 13, 'subcategory2_id' => 32, 'score' => 3],
            ['subcategory1_id' => 13, 'subcategory2_id' => 33, 'score' => 3],
            ['subcategory1_id' => 13, 'subcategory2_id' => 34, 'score' => 2],

            ['subcategory1_id' => 14, 'subcategory2_id' => 11, 'score' => 3],
            ['subcategory1_id' => 14, 'subcategory2_id' => 12, 'score' => 4],
            ['subcategory1_id' => 14, 'subcategory2_id' => 13, 'score' => 4],
            ['subcategory1_id' => 14, 'subcategory2_id' => 14, 'score' => 5],
            ['subcategory1_id' => 14, 'subcategory2_id' => 15, 'score' => 3],
            ['subcategory1_id' => 14, 'subcategory2_id' => 16, 'score' => 4],
            ['subcategory1_id' => 14, 'subcategory2_id' => 17, 'score' => 4],
            ['subcategory1_id' => 14, 'subcategory2_id' => 18, 'score' => 4],
            ['subcategory1_id' => 14, 'subcategory2_id' => 19, 'score' => 4],
            ['subcategory1_id' => 14, 'subcategory2_id' => 20, 'score' => 4],
            ['subcategory1_id' => 14, 'subcategory2_id' => 21, 'score' => 2],
            ['subcategory1_id' => 14, 'subcategory2_id' => 22, 'score' => 3],
            ['subcategory1_id' => 14, 'subcategory2_id' => 23, 'score' => 2],
            ['subcategory1_id' => 14, 'subcategory2_id' => 24, 'score' => 3],
            ['subcategory1_id' => 14, 'subcategory2_id' => 25, 'score' => 4],
            ['subcategory1_id' => 14, 'subcategory2_id' => 26, 'score' => 4],
            ['subcategory1_id' => 14, 'subcategory2_id' => 27, 'score' => 3],
            ['subcategory1_id' => 14, 'subcategory2_id' => 28, 'score' => 2],
            ['subcategory1_id' => 14, 'subcategory2_id' => 29, 'score' => 3],
            ['subcategory1_id' => 14, 'subcategory2_id' => 30, 'score' => 3],
            ['subcategory1_id' => 14, 'subcategory2_id' => 31, 'score' => 4],
            ['subcategory1_id' => 14, 'subcategory2_id' => 32, 'score' => 3],
            ['subcategory1_id' => 14, 'subcategory2_id' => 33, 'score' => 3],
            ['subcategory1_id' => 14, 'subcategory2_id' => 34, 'score' => 2],

            ['subcategory1_id' => 15, 'subcategory2_id' => 11, 'score' => 3],
            ['subcategory1_id' => 15, 'subcategory2_id' => 12, 'score' => 2],
            ['subcategory1_id' => 15, 'subcategory2_id' => 13, 'score' => 3],
            ['subcategory1_id' => 15, 'subcategory2_id' => 14, 'score' => 3],
            ['subcategory1_id' => 15, 'subcategory2_id' => 15, 'score' => 5],
            ['subcategory1_id' => 15, 'subcategory2_id' => 16, 'score' => 4],
            ['subcategory1_id' => 15, 'subcategory2_id' => 17, 'score' => 4],
            ['subcategory1_id' => 15, 'subcategory2_id' => 18, 'score' => 4],
            ['subcategory1_id' => 15, 'subcategory2_id' => 19, 'score' => 4],
            ['subcategory1_id' => 15, 'subcategory2_id' => 20, 'score' => 4],
            ['subcategory1_id' => 15, 'subcategory2_id' => 21, 'score' => 2],
            ['subcategory1_id' => 15, 'subcategory2_id' => 22, 'score' => 3],
            ['subcategory1_id' => 15, 'subcategory2_id' => 23, 'score' => 2],
            ['subcategory1_id' => 15, 'subcategory2_id' => 24, 'score' => 3],
            ['subcategory1_id' => 15, 'subcategory2_id' => 25, 'score' => 4],
            ['subcategory1_id' => 15, 'subcategory2_id' => 26, 'score' => 4],
            ['subcategory1_id' => 15, 'subcategory2_id' => 27, 'score' => 3],
            ['subcategory1_id' => 15, 'subcategory2_id' => 28, 'score' => 2],
            ['subcategory1_id' => 15, 'subcategory2_id' => 29, 'score' => 3],
            ['subcategory1_id' => 15, 'subcategory2_id' => 30, 'score' => 3],
            ['subcategory1_id' => 15, 'subcategory2_id' => 31, 'score' => 4],
            ['subcategory1_id' => 15, 'subcategory2_id' => 32, 'score' => 3],
            ['subcategory1_id' => 15, 'subcategory2_id' => 33, 'score' => 3],
            ['subcategory1_id' => 15, 'subcategory2_id' => 34, 'score' => 2],

            ['subcategory1_id' => 16, 'subcategory2_id' => 11, 'score' => 3],
            ['subcategory1_id' => 16, 'subcategory2_id' => 12, 'score' => 3],
            ['subcategory1_id' => 16, 'subcategory2_id' => 13, 'score' => 4],
            ['subcategory1_id' => 16, 'subcategory2_id' => 14, 'score' => 4],
            ['subcategory1_id' => 16, 'subcategory2_id' => 15, 'score' => 4],
            ['subcategory1_id' => 16, 'subcategory2_id' => 16, 'score' => 5],
            ['subcategory1_id' => 16, 'subcategory2_id' => 17, 'score' => 4],
            ['subcategory1_id' => 16, 'subcategory2_id' => 18, 'score' => 4],
            ['subcategory1_id' => 16, 'subcategory2_id' => 19, 'score' => 4],
            ['subcategory1_id' => 16, 'subcategory2_id' => 20, 'score' => 4],
            ['subcategory1_id' => 16, 'subcategory2_id' => 21, 'score' => 2],
            ['subcategory1_id' => 16, 'subcategory2_id' => 22, 'score' => 3],
            ['subcategory1_id' => 16, 'subcategory2_id' => 23, 'score' => 2],
            ['subcategory1_id' => 16, 'subcategory2_id' => 24, 'score' => 3],
            ['subcategory1_id' => 16, 'subcategory2_id' => 25, 'score' => 4],
            ['subcategory1_id' => 16, 'subcategory2_id' => 26, 'score' => 4],
            ['subcategory1_id' => 16, 'subcategory2_id' => 27, 'score' => 3],
            ['subcategory1_id' => 16, 'subcategory2_id' => 28, 'score' => 2],
            ['subcategory1_id' => 16, 'subcategory2_id' => 29, 'score' => 3],
            ['subcategory1_id' => 16, 'subcategory2_id' => 30, 'score' => 3],
            ['subcategory1_id' => 16, 'subcategory2_id' => 31, 'score' => 4],
            ['subcategory1_id' => 16, 'subcategory2_id' => 32, 'score' => 3],
            ['subcategory1_id' => 16, 'subcategory2_id' => 33, 'score' => 3],
            ['subcategory1_id' => 16, 'subcategory2_id' => 34, 'score' => 2],

            ['subcategory1_id' => 17, 'subcategory2_id' => 11, 'score' => 3],
            ['subcategory1_id' => 17, 'subcategory2_id' => 12, 'score' => 4],
            ['subcategory1_id' => 17, 'subcategory2_id' => 13, 'score' => 4],
            ['subcategory1_id' => 17, 'subcategory2_id' => 14, 'score' => 4],
            ['subcategory1_id' => 17, 'subcategory2_id' => 15, 'score' => 4],
            ['subcategory1_id' => 17, 'subcategory2_id' => 16, 'score' => 4],
            ['subcategory1_id' => 17, 'subcategory2_id' => 17, 'score' => 5],
            ['subcategory1_id' => 17, 'subcategory2_id' => 18, 'score' => 4],
            ['subcategory1_id' => 17, 'subcategory2_id' => 19, 'score' => 4],
            ['subcategory1_id' => 17, 'subcategory2_id' => 20, 'score' => 4],
            ['subcategory1_id' => 17, 'subcategory2_id' => 21, 'score' => 2],
            ['subcategory1_id' => 17, 'subcategory2_id' => 22, 'score' => 3],
            ['subcategory1_id' => 17, 'subcategory2_id' => 23, 'score' => 2],
            ['subcategory1_id' => 17, 'subcategory2_id' => 24, 'score' => 3],
            ['subcategory1_id' => 17, 'subcategory2_id' => 25, 'score' => 4],
            ['subcategory1_id' => 17, 'subcategory2_id' => 26, 'score' => 4],
            ['subcategory1_id' => 17, 'subcategory2_id' => 27, 'score' => 3],
            ['subcategory1_id' => 17, 'subcategory2_id' => 28, 'score' => 2],
            ['subcategory1_id' => 17, 'subcategory2_id' => 29, 'score' => 3],
            ['subcategory1_id' => 17, 'subcategory2_id' => 30, 'score' => 3],
            ['subcategory1_id' => 17, 'subcategory2_id' => 31, 'score' => 4],
            ['subcategory1_id' => 17, 'subcategory2_id' => 32, 'score' => 3],
            ['subcategory1_id' => 17, 'subcategory2_id' => 33, 'score' => 3],
            ['subcategory1_id' => 17, 'subcategory2_id' => 34, 'score' => 2],

            ['subcategory1_id' => 18, 'subcategory2_id' => 11, 'score' => 3],
            ['subcategory1_id' => 18, 'subcategory2_id' => 12, 'score' => 4],
            ['subcategory1_id' => 18, 'subcategory2_id' => 13, 'score' => 4],
            ['subcategory1_id' => 18, 'subcategory2_id' => 14, 'score' => 4],
            ['subcategory1_id' => 18, 'subcategory2_id' => 15, 'score' => 4],
            ['subcategory1_id' => 18, 'subcategory2_id' => 16, 'score' => 4],
            ['subcategory1_id' => 18, 'subcategory2_id' => 17, 'score' => 4],
            ['subcategory1_id' => 18, 'subcategory2_id' => 18, 'score' => 5],
            ['subcategory1_id' => 18, 'subcategory2_id' => 19, 'score' => 4],
            ['subcategory1_id' => 18, 'subcategory2_id' => 20, 'score' => 4],
            ['subcategory1_id' => 18, 'subcategory2_id' => 21, 'score' => 2],
            ['subcategory1_id' => 18, 'subcategory2_id' => 22, 'score' => 3],
            ['subcategory1_id' => 18, 'subcategory2_id' => 23, 'score' => 2],
            ['subcategory1_id' => 18, 'subcategory2_id' => 24, 'score' => 3],
            ['subcategory1_id' => 18, 'subcategory2_id' => 25, 'score' => 4],
            ['subcategory1_id' => 18, 'subcategory2_id' => 26, 'score' => 4],
            ['subcategory1_id' => 18, 'subcategory2_id' => 27, 'score' => 3],
            ['subcategory1_id' => 18, 'subcategory2_id' => 28, 'score' => 2],
            ['subcategory1_id' => 18, 'subcategory2_id' => 29, 'score' => 3],
            ['subcategory1_id' => 18, 'subcategory2_id' => 30, 'score' => 3],
            ['subcategory1_id' => 18, 'subcategory2_id' => 31, 'score' => 4],
            ['subcategory1_id' => 18, 'subcategory2_id' => 32, 'score' => 3],
            ['subcategory1_id' => 18, 'subcategory2_id' => 33, 'score' => 3],
            ['subcategory1_id' => 18, 'subcategory2_id' => 34, 'score' => 2],

            ['subcategory1_id' => 19, 'subcategory2_id' => 11, 'score' => 3],
            ['subcategory1_id' => 19, 'subcategory2_id' => 12, 'score' => 4],
            ['subcategory1_id' => 19, 'subcategory2_id' => 13, 'score' => 4],
            ['subcategory1_id' => 19, 'subcategory2_id' => 14, 'score' => 4],
            ['subcategory1_id' => 19, 'subcategory2_id' => 15, 'score' => 4],
            ['subcategory1_id' => 19, 'subcategory2_id' => 16, 'score' => 4],
            ['subcategory1_id' => 19, 'subcategory2_id' => 17, 'score' => 4],
            ['subcategory1_id' => 19, 'subcategory2_id' => 18, 'score' => 4],
            ['subcategory1_id' => 19, 'subcategory2_id' => 19, 'score' => 5],
            ['subcategory1_id' => 19, 'subcategory2_id' => 20, 'score' => 4],
            ['subcategory1_id' => 19, 'subcategory2_id' => 21, 'score' => 2],
            ['subcategory1_id' => 19, 'subcategory2_id' => 22, 'score' => 3],
            ['subcategory1_id' => 19, 'subcategory2_id' => 23, 'score' => 2],
            ['subcategory1_id' => 19, 'subcategory2_id' => 24, 'score' => 3],
            ['subcategory1_id' => 19, 'subcategory2_id' => 25, 'score' => 4],
            ['subcategory1_id' => 19, 'subcategory2_id' => 26, 'score' => 4],
            ['subcategory1_id' => 19, 'subcategory2_id' => 27, 'score' => 3],
            ['subcategory1_id' => 19, 'subcategory2_id' => 28, 'score' => 2],
            ['subcategory1_id' => 19, 'subcategory2_id' => 29, 'score' => 3],
            ['subcategory1_id' => 19, 'subcategory2_id' => 30, 'score' => 3],
            ['subcategory1_id' => 19, 'subcategory2_id' => 31, 'score' => 4],
            ['subcategory1_id' => 19, 'subcategory2_id' => 32, 'score' => 3],
            ['subcategory1_id' => 19, 'subcategory2_id' => 33, 'score' => 3],
            ['subcategory1_id' => 19, 'subcategory2_id' => 34, 'score' => 2],

            ['subcategory1_id' => 20, 'subcategory2_id' => 11, 'score' => 3],
            ['subcategory1_id' => 20, 'subcategory2_id' => 12, 'score' => 4],
            ['subcategory1_id' => 20, 'subcategory2_id' => 13, 'score' => 4],
            ['subcategory1_id' => 20, 'subcategory2_id' => 14, 'score' => 4],
            ['subcategory1_id' => 20, 'subcategory2_id' => 15, 'score' => 4],
            ['subcategory1_id' => 20, 'subcategory2_id' => 16, 'score' => 4],
            ['subcategory1_id' => 20, 'subcategory2_id' => 17, 'score' => 4],
            ['subcategory1_id' => 20, 'subcategory2_id' => 18, 'score' => 4],
            ['subcategory1_id' => 20, 'subcategory2_id' => 19, 'score' => 4],
            ['subcategory1_id' => 20, 'subcategory2_id' => 20, 'score' => 5],
            ['subcategory1_id' => 20, 'subcategory2_id' => 21, 'score' => 2],
            ['subcategory1_id' => 20, 'subcategory2_id' => 22, 'score' => 3],
            ['subcategory1_id' => 20, 'subcategory2_id' => 23, 'score' => 2],
            ['subcategory1_id' => 20, 'subcategory2_id' => 24, 'score' => 3],
            ['subcategory1_id' => 20, 'subcategory2_id' => 25, 'score' => 4],
            ['subcategory1_id' => 20, 'subcategory2_id' => 26, 'score' => 4],
            ['subcategory1_id' => 20, 'subcategory2_id' => 27, 'score' => 3],
            ['subcategory1_id' => 20, 'subcategory2_id' => 28, 'score' => 2],
            ['subcategory1_id' => 20, 'subcategory2_id' => 29, 'score' => 3],
            ['subcategory1_id' => 20, 'subcategory2_id' => 30, 'score' => 3],
            ['subcategory1_id' => 20, 'subcategory2_id' => 31, 'score' => 4],
            ['subcategory1_id' => 20, 'subcategory2_id' => 32, 'score' => 3],
            ['subcategory1_id' => 20, 'subcategory2_id' => 33, 'score' => 3],
            ['subcategory1_id' => 20, 'subcategory2_id' => 34, 'score' => 2],

            ['subcategory1_id' => 21, 'subcategory2_id' => 11, 'score' => 2],
            ['subcategory1_id' => 21, 'subcategory2_id' => 12, 'score' => 2],
            ['subcategory1_id' => 21, 'subcategory2_id' => 13, 'score' => 2],
            ['subcategory1_id' => 21, 'subcategory2_id' => 14, 'score' => 2],
            ['subcategory1_id' => 21, 'subcategory2_id' => 15, 'score' => 2],
            ['subcategory1_id' => 21, 'subcategory2_id' => 16, 'score' => 2],
            ['subcategory1_id' => 21, 'subcategory2_id' => 17, 'score' => 2],
            ['subcategory1_id' => 21, 'subcategory2_id' => 18, 'score' => 2],
            ['subcategory1_id' => 21, 'subcategory2_id' => 19, 'score' => 2],
            ['subcategory1_id' => 21, 'subcategory2_id' => 20, 'score' => 2],
            ['subcategory1_id' => 21, 'subcategory2_id' => 21, 'score' => 5],
            ['subcategory1_id' => 21, 'subcategory2_id' => 22, 'score' => 4],
            ['subcategory1_id' => 21, 'subcategory2_id' => 23, 'score' => 3],
            ['subcategory1_id' => 21, 'subcategory2_id' => 24, 'score' => 4],
            ['subcategory1_id' => 21, 'subcategory2_id' => 25, 'score' => 4],
            ['subcategory1_id' => 21, 'subcategory2_id' => 26, 'score' => 4],
            ['subcategory1_id' => 21, 'subcategory2_id' => 27, 'score' => 3],
            ['subcategory1_id' => 21, 'subcategory2_id' => 28, 'score' => 2],
            ['subcategory1_id' => 21, 'subcategory2_id' => 29, 'score' => 3],
            ['subcategory1_id' => 21, 'subcategory2_id' => 30, 'score' => 3],
            ['subcategory1_id' => 21, 'subcategory2_id' => 31, 'score' => 4],
            ['subcategory1_id' => 21, 'subcategory2_id' => 32, 'score' => 3],
            ['subcategory1_id' => 21, 'subcategory2_id' => 33, 'score' => 3],
            ['subcategory1_id' => 21, 'subcategory2_id' => 34, 'score' => 2],

            ['subcategory1_id' => 22, 'subcategory2_id' => 11, 'score' => 3],
            ['subcategory1_id' => 22, 'subcategory2_id' => 12, 'score' => 4],
            ['subcategory1_id' => 22, 'subcategory2_id' => 13, 'score' => 4],
            ['subcategory1_id' => 22, 'subcategory2_id' => 14, 'score' => 4],
            ['subcategory1_id' => 22, 'subcategory2_id' => 15, 'score' => 4],
            ['subcategory1_id' => 22, 'subcategory2_id' => 16, 'score' => 4],
            ['subcategory1_id' => 22, 'subcategory2_id' => 17, 'score' => 4],
            ['subcategory1_id' => 22, 'subcategory2_id' => 18, 'score' => 4],
            ['subcategory1_id' => 22, 'subcategory2_id' => 19, 'score' => 4],
            ['subcategory1_id' => 22, 'subcategory2_id' => 20, 'score' => 4],
            ['subcategory1_id' => 22, 'subcategory2_id' => 21, 'score' => 2],
            ['subcategory1_id' => 22, 'subcategory2_id' => 22, 'score' => 5],
            ['subcategory1_id' => 22, 'subcategory2_id' => 23, 'score' => 3],
            ['subcategory1_id' => 22, 'subcategory2_id' => 24, 'score' => 4],
            ['subcategory1_id' => 22, 'subcategory2_id' => 25, 'score' => 4],
            ['subcategory1_id' => 22, 'subcategory2_id' => 26, 'score' => 4],
            ['subcategory1_id' => 22, 'subcategory2_id' => 27, 'score' => 3],
            ['subcategory1_id' => 22, 'subcategory2_id' => 28, 'score' => 2],
            ['subcategory1_id' => 22, 'subcategory2_id' => 29, 'score' => 3],
            ['subcategory1_id' => 22, 'subcategory2_id' => 30, 'score' => 3],
            ['subcategory1_id' => 22, 'subcategory2_id' => 31, 'score' => 4],
            ['subcategory1_id' => 22, 'subcategory2_id' => 32, 'score' => 3],
            ['subcategory1_id' => 22, 'subcategory2_id' => 33, 'score' => 3],
            ['subcategory1_id' => 22, 'subcategory2_id' => 34, 'score' => 2],

            ['subcategory1_id' => 23, 'subcategory2_id' => 11, 'score' => 3],
            ['subcategory1_id' => 23, 'subcategory2_id' => 12, 'score' => 4],
            ['subcategory1_id' => 23, 'subcategory2_id' => 13, 'score' => 4],
            ['subcategory1_id' => 23, 'subcategory2_id' => 14, 'score' => 4],
            ['subcategory1_id' => 23, 'subcategory2_id' => 15, 'score' => 4],
            ['subcategory1_id' => 23, 'subcategory2_id' => 16, 'score' => 1],
            ['subcategory1_id' => 23, 'subcategory2_id' => 17, 'score' => 2],
            ['subcategory1_id' => 23, 'subcategory2_id' => 18, 'score' => 3],
            ['subcategory1_id' => 23, 'subcategory2_id' => 19, 'score' => 4],
            ['subcategory1_id' => 23, 'subcategory2_id' => 20, 'score' => 4],
            ['subcategory1_id' => 23, 'subcategory2_id' => 21, 'score' => 2],
            ['subcategory1_id' => 23, 'subcategory2_id' => 22, 'score' => 3],
            ['subcategory1_id' => 23, 'subcategory2_id' => 23, 'score' => 5],
            ['subcategory1_id' => 23, 'subcategory2_id' => 24, 'score' => 4],
            ['subcategory1_id' => 23, 'subcategory2_id' => 25, 'score' => 4],
            ['subcategory1_id' => 23, 'subcategory2_id' => 26, 'score' => 4],
            ['subcategory1_id' => 23, 'subcategory2_id' => 27, 'score' => 3],
            ['subcategory1_id' => 23, 'subcategory2_id' => 28, 'score' => 2],
            ['subcategory1_id' => 23, 'subcategory2_id' => 29, 'score' => 3],
            ['subcategory1_id' => 23, 'subcategory2_id' => 30, 'score' => 3],
            ['subcategory1_id' => 23, 'subcategory2_id' => 31, 'score' => 4],
            ['subcategory1_id' => 23, 'subcategory2_id' => 32, 'score' => 3],
            ['subcategory1_id' => 23, 'subcategory2_id' => 33, 'score' => 3],
            ['subcategory1_id' => 23, 'subcategory2_id' => 34, 'score' => 2],

            ['subcategory1_id' => 24, 'subcategory2_id' => 11, 'score' => 3],
            ['subcategory1_id' => 24, 'subcategory2_id' => 12, 'score' => 4],
            ['subcategory1_id' => 24, 'subcategory2_id' => 13, 'score' => 4],
            ['subcategory1_id' => 24, 'subcategory2_id' => 14, 'score' => 4],
            ['subcategory1_id' => 24, 'subcategory2_id' => 15, 'score' => 4],
            ['subcategory1_id' => 24, 'subcategory2_id' => 16, 'score' => 4],
            ['subcategory1_id' => 24, 'subcategory2_id' => 17, 'score' => 4],
            ['subcategory1_id' => 24, 'subcategory2_id' => 18, 'score' => 4],
            ['subcategory1_id' => 24, 'subcategory2_id' => 19, 'score' => 4],
            ['subcategory1_id' => 24, 'subcategory2_id' => 20, 'score' => 4],
            ['subcategory1_id' => 24, 'subcategory2_id' => 21, 'score' => 2],
            ['subcategory1_id' => 24, 'subcategory2_id' => 22, 'score' => 3],
            ['subcategory1_id' => 24, 'subcategory2_id' => 23, 'score' => 2],
            ['subcategory1_id' => 24, 'subcategory2_id' => 24, 'score' => 5],
            ['subcategory1_id' => 24, 'subcategory2_id' => 25, 'score' => 4],
            ['subcategory1_id' => 24, 'subcategory2_id' => 26, 'score' => 4],
            ['subcategory1_id' => 24, 'subcategory2_id' => 27, 'score' => 3],
            ['subcategory1_id' => 24, 'subcategory2_id' => 28, 'score' => 2],
            ['subcategory1_id' => 24, 'subcategory2_id' => 29, 'score' => 3],
            ['subcategory1_id' => 24, 'subcategory2_id' => 30, 'score' => 3],
            ['subcategory1_id' => 24, 'subcategory2_id' => 31, 'score' => 4],
            ['subcategory1_id' => 24, 'subcategory2_id' => 32, 'score' => 3],
            ['subcategory1_id' => 24, 'subcategory2_id' => 33, 'score' => 3],
            ['subcategory1_id' => 24, 'subcategory2_id' => 34, 'score' => 2],

            ['subcategory1_id' => 25, 'subcategory2_id' => 11, 'score' => 3],
            ['subcategory1_id' => 25, 'subcategory2_id' => 12, 'score' => 2],
            ['subcategory1_id' => 25, 'subcategory2_id' => 13, 'score' => 3],
            ['subcategory1_id' => 25, 'subcategory2_id' => 14, 'score' => 3],
            ['subcategory1_id' => 25, 'subcategory2_id' => 15, 'score' => 5],
            ['subcategory1_id' => 25, 'subcategory2_id' => 16, 'score' => 4],
            ['subcategory1_id' => 25, 'subcategory2_id' => 17, 'score' => 4],
            ['subcategory1_id' => 25, 'subcategory2_id' => 18, 'score' => 4],
            ['subcategory1_id' => 25, 'subcategory2_id' => 19, 'score' => 4],
            ['subcategory1_id' => 25, 'subcategory2_id' => 20, 'score' => 4],
            ['subcategory1_id' => 25, 'subcategory2_id' => 21, 'score' => 2],
            ['subcategory1_id' => 25, 'subcategory2_id' => 22, 'score' => 3],
            ['subcategory1_id' => 25, 'subcategory2_id' => 23, 'score' => 2],
            ['subcategory1_id' => 25, 'subcategory2_id' => 24, 'score' => 3],
            ['subcategory1_id' => 25, 'subcategory2_id' => 25, 'score' => 4],
            ['subcategory1_id' => 25, 'subcategory2_id' => 26, 'score' => 4],
            ['subcategory1_id' => 25, 'subcategory2_id' => 27, 'score' => 3],
            ['subcategory1_id' => 25, 'subcategory2_id' => 28, 'score' => 2],
            ['subcategory1_id' => 25, 'subcategory2_id' => 29, 'score' => 3],
            ['subcategory1_id' => 25, 'subcategory2_id' => 30, 'score' => 3],
            ['subcategory1_id' => 25, 'subcategory2_id' => 31, 'score' => 4],
            ['subcategory1_id' => 25, 'subcategory2_id' => 32, 'score' => 3],
            ['subcategory1_id' => 25, 'subcategory2_id' => 33, 'score' => 3],
            ['subcategory1_id' => 25, 'subcategory2_id' => 34, 'score' => 2],

            ['subcategory1_id' => 26, 'subcategory2_id' => 11, 'score' => 3],
            ['subcategory1_id' => 26, 'subcategory2_id' => 12, 'score' => 3],
            ['subcategory1_id' => 26, 'subcategory2_id' => 13, 'score' => 4],
            ['subcategory1_id' => 26, 'subcategory2_id' => 14, 'score' => 4],
            ['subcategory1_id' => 26, 'subcategory2_id' => 15, 'score' => 4],
            ['subcategory1_id' => 26, 'subcategory2_id' => 16, 'score' => 5],
            ['subcategory1_id' => 26, 'subcategory2_id' => 17, 'score' => 4],
            ['subcategory1_id' => 26, 'subcategory2_id' => 18, 'score' => 4],
            ['subcategory1_id' => 26, 'subcategory2_id' => 19, 'score' => 4],
            ['subcategory1_id' => 26, 'subcategory2_id' => 20, 'score' => 4],
            ['subcategory1_id' => 26, 'subcategory2_id' => 21, 'score' => 2],
            ['subcategory1_id' => 26, 'subcategory2_id' => 22, 'score' => 3],
            ['subcategory1_id' => 26, 'subcategory2_id' => 23, 'score' => 2],
            ['subcategory1_id' => 26, 'subcategory2_id' => 24, 'score' => 3],
            ['subcategory1_id' => 26, 'subcategory2_id' => 25, 'score' => 4],
            ['subcategory1_id' => 26, 'subcategory2_id' => 26, 'score' => 4],
            ['subcategory1_id' => 26, 'subcategory2_id' => 27, 'score' => 3],
            ['subcategory1_id' => 26, 'subcategory2_id' => 28, 'score' => 2],
            ['subcategory1_id' => 26, 'subcategory2_id' => 29, 'score' => 3],
            ['subcategory1_id' => 26, 'subcategory2_id' => 30, 'score' => 3],
            ['subcategory1_id' => 26, 'subcategory2_id' => 31, 'score' => 4],
            ['subcategory1_id' => 26, 'subcategory2_id' => 32, 'score' => 3],
            ['subcategory1_id' => 26, 'subcategory2_id' => 33, 'score' => 3],
            ['subcategory1_id' => 26, 'subcategory2_id' => 34, 'score' => 2],

            ['subcategory1_id' => 27, 'subcategory2_id' => 11, 'score' => 3],
            ['subcategory1_id' => 27, 'subcategory2_id' => 12, 'score' => 4],
            ['subcategory1_id' => 27, 'subcategory2_id' => 13, 'score' => 4],
            ['subcategory1_id' => 27, 'subcategory2_id' => 14, 'score' => 4],
            ['subcategory1_id' => 27, 'subcategory2_id' => 15, 'score' => 4],
            ['subcategory1_id' => 27, 'subcategory2_id' => 16, 'score' => 4],
            ['subcategory1_id' => 27, 'subcategory2_id' => 17, 'score' => 5],
            ['subcategory1_id' => 27, 'subcategory2_id' => 18, 'score' => 4],
            ['subcategory1_id' => 27, 'subcategory2_id' => 19, 'score' => 4],
            ['subcategory1_id' => 27, 'subcategory2_id' => 20, 'score' => 4],
            ['subcategory1_id' => 27, 'subcategory2_id' => 21, 'score' => 2],
            ['subcategory1_id' => 27, 'subcategory2_id' => 22, 'score' => 3],
            ['subcategory1_id' => 27, 'subcategory2_id' => 23, 'score' => 2],
            ['subcategory1_id' => 27, 'subcategory2_id' => 24, 'score' => 3],
            ['subcategory1_id' => 27, 'subcategory2_id' => 25, 'score' => 4],
            ['subcategory1_id' => 27, 'subcategory2_id' => 26, 'score' => 4],
            ['subcategory1_id' => 27, 'subcategory2_id' => 27, 'score' => 3],
            ['subcategory1_id' => 27, 'subcategory2_id' => 28, 'score' => 2],
            ['subcategory1_id' => 27, 'subcategory2_id' => 29, 'score' => 3],
            ['subcategory1_id' => 27, 'subcategory2_id' => 30, 'score' => 3],
            ['subcategory1_id' => 27, 'subcategory2_id' => 31, 'score' => 4],
            ['subcategory1_id' => 27, 'subcategory2_id' => 32, 'score' => 3],
            ['subcategory1_id' => 27, 'subcategory2_id' => 33, 'score' => 3],
            ['subcategory1_id' => 27, 'subcategory2_id' => 34, 'score' => 2],

            ['subcategory1_id' => 28, 'subcategory2_id' => 11, 'score' => 3],
            ['subcategory1_id' => 28, 'subcategory2_id' => 12, 'score' => 4],
            ['subcategory1_id' => 28, 'subcategory2_id' => 13, 'score' => 4],
            ['subcategory1_id' => 28, 'subcategory2_id' => 14, 'score' => 4],
            ['subcategory1_id' => 28, 'subcategory2_id' => 15, 'score' => 4],
            ['subcategory1_id' => 28, 'subcategory2_id' => 16, 'score' => 4],
            ['subcategory1_id' => 28, 'subcategory2_id' => 17, 'score' => 4],
            ['subcategory1_id' => 28, 'subcategory2_id' => 18, 'score' => 5],
            ['subcategory1_id' => 28, 'subcategory2_id' => 19, 'score' => 4],
            ['subcategory1_id' => 28, 'subcategory2_id' => 20, 'score' => 4],
            ['subcategory1_id' => 28, 'subcategory2_id' => 21, 'score' => 2],
            ['subcategory1_id' => 28, 'subcategory2_id' => 22, 'score' => 3],
            ['subcategory1_id' => 28, 'subcategory2_id' => 23, 'score' => 2],
            ['subcategory1_id' => 28, 'subcategory2_id' => 24, 'score' => 3],
            ['subcategory1_id' => 28, 'subcategory2_id' => 25, 'score' => 4],
            ['subcategory1_id' => 28, 'subcategory2_id' => 26, 'score' => 4],
            ['subcategory1_id' => 28, 'subcategory2_id' => 27, 'score' => 3],
            ['subcategory1_id' => 28, 'subcategory2_id' => 28, 'score' => 2],
            ['subcategory1_id' => 28, 'subcategory2_id' => 29, 'score' => 3],
            ['subcategory1_id' => 28, 'subcategory2_id' => 30, 'score' => 3],
            ['subcategory1_id' => 28, 'subcategory2_id' => 31, 'score' => 4],
            ['subcategory1_id' => 28, 'subcategory2_id' => 32, 'score' => 3],
            ['subcategory1_id' => 28, 'subcategory2_id' => 33, 'score' => 3],
            ['subcategory1_id' => 28, 'subcategory2_id' => 34, 'score' => 2],

            ['subcategory1_id' => 29, 'subcategory2_id' => 11, 'score' => 3],
            ['subcategory1_id' => 29, 'subcategory2_id' => 12, 'score' => 4],
            ['subcategory1_id' => 29, 'subcategory2_id' => 13, 'score' => 4],
            ['subcategory1_id' => 29, 'subcategory2_id' => 14, 'score' => 4],
            ['subcategory1_id' => 29, 'subcategory2_id' => 15, 'score' => 4],
            ['subcategory1_id' => 29, 'subcategory2_id' => 16, 'score' => 4],
            ['subcategory1_id' => 29, 'subcategory2_id' => 17, 'score' => 4],
            ['subcategory1_id' => 29, 'subcategory2_id' => 18, 'score' => 4],
            ['subcategory1_id' => 29, 'subcategory2_id' => 19, 'score' => 5],
            ['subcategory1_id' => 29, 'subcategory2_id' => 20, 'score' => 4],
            ['subcategory1_id' => 29, 'subcategory2_id' => 21, 'score' => 2],
            ['subcategory1_id' => 29, 'subcategory2_id' => 22, 'score' => 3],
            ['subcategory1_id' => 29, 'subcategory2_id' => 23, 'score' => 2],
            ['subcategory1_id' => 29, 'subcategory2_id' => 24, 'score' => 3],
            ['subcategory1_id' => 29, 'subcategory2_id' => 25, 'score' => 4],
            ['subcategory1_id' => 29, 'subcategory2_id' => 26, 'score' => 4],
            ['subcategory1_id' => 29, 'subcategory2_id' => 27, 'score' => 3],
            ['subcategory1_id' => 29, 'subcategory2_id' => 28, 'score' => 2],
            ['subcategory1_id' => 29, 'subcategory2_id' => 29, 'score' => 3],
            ['subcategory1_id' => 29, 'subcategory2_id' => 30, 'score' => 3],
            ['subcategory1_id' => 29, 'subcategory2_id' => 31, 'score' => 4],
            ['subcategory1_id' => 29, 'subcategory2_id' => 32, 'score' => 3],
            ['subcategory1_id' => 29, 'subcategory2_id' => 33, 'score' => 3],
            ['subcategory1_id' => 29, 'subcategory2_id' => 34, 'score' => 2],

            ['subcategory1_id' => 30, 'subcategory2_id' => 11, 'score' => 3],
            ['subcategory1_id' => 30, 'subcategory2_id' => 12, 'score' => 4],
            ['subcategory1_id' => 30, 'subcategory2_id' => 13, 'score' => 4],
            ['subcategory1_id' => 30, 'subcategory2_id' => 14, 'score' => 4],
            ['subcategory1_id' => 30, 'subcategory2_id' => 15, 'score' => 4],
            ['subcategory1_id' => 30, 'subcategory2_id' => 16, 'score' => 4],
            ['subcategory1_id' => 30, 'subcategory2_id' => 17, 'score' => 4],
            ['subcategory1_id' => 30, 'subcategory2_id' => 18, 'score' => 4],
            ['subcategory1_id' => 30, 'subcategory2_id' => 19, 'score' => 4],
            ['subcategory1_id' => 30, 'subcategory2_id' => 20, 'score' => 5],
            ['subcategory1_id' => 30, 'subcategory2_id' => 21, 'score' => 2],
            ['subcategory1_id' => 30, 'subcategory2_id' => 22, 'score' => 3],
            ['subcategory1_id' => 30, 'subcategory2_id' => 23, 'score' => 2],
            ['subcategory1_id' => 30, 'subcategory2_id' => 24, 'score' => 3],
            ['subcategory1_id' => 30, 'subcategory2_id' => 25, 'score' => 4],
            ['subcategory1_id' => 30, 'subcategory2_id' => 26, 'score' => 4],
            ['subcategory1_id' => 30, 'subcategory2_id' => 27, 'score' => 3],
            ['subcategory1_id' => 30, 'subcategory2_id' => 28, 'score' => 2],
            ['subcategory1_id' => 30, 'subcategory2_id' => 29, 'score' => 3],
            ['subcategory1_id' => 30, 'subcategory2_id' => 30, 'score' => 3],
            ['subcategory1_id' => 30, 'subcategory2_id' => 31, 'score' => 4],
            ['subcategory1_id' => 30, 'subcategory2_id' => 32, 'score' => 3],
            ['subcategory1_id' => 30, 'subcategory2_id' => 33, 'score' => 3],
            ['subcategory1_id' => 30, 'subcategory2_id' => 34, 'score' => 2],

            ['subcategory1_id' => 31, 'subcategory2_id' => 11, 'score' => 2],
            ['subcategory1_id' => 31, 'subcategory2_id' => 12, 'score' => 2],
            ['subcategory1_id' => 31, 'subcategory2_id' => 13, 'score' => 2],
            ['subcategory1_id' => 31, 'subcategory2_id' => 14, 'score' => 2],
            ['subcategory1_id' => 31, 'subcategory2_id' => 15, 'score' => 2],
            ['subcategory1_id' => 31, 'subcategory2_id' => 16, 'score' => 2],
            ['subcategory1_id' => 31, 'subcategory2_id' => 17, 'score' => 2],
            ['subcategory1_id' => 31, 'subcategory2_id' => 18, 'score' => 2],
            ['subcategory1_id' => 31, 'subcategory2_id' => 19, 'score' => 2],
            ['subcategory1_id' => 31, 'subcategory2_id' => 20, 'score' => 2],
            ['subcategory1_id' => 31, 'subcategory2_id' => 21, 'score' => 5],
            ['subcategory1_id' => 31, 'subcategory2_id' => 22, 'score' => 4],
            ['subcategory1_id' => 31, 'subcategory2_id' => 23, 'score' => 3],
            ['subcategory1_id' => 31, 'subcategory2_id' => 24, 'score' => 4],
            ['subcategory1_id' => 31, 'subcategory2_id' => 25, 'score' => 4],
            ['subcategory1_id' => 31, 'subcategory2_id' => 26, 'score' => 4],
            ['subcategory1_id' => 31, 'subcategory2_id' => 27, 'score' => 3],
            ['subcategory1_id' => 31, 'subcategory2_id' => 28, 'score' => 2],
            ['subcategory1_id' => 31, 'subcategory2_id' => 29, 'score' => 3],
            ['subcategory1_id' => 31, 'subcategory2_id' => 30, 'score' => 3],
            ['subcategory1_id' => 31, 'subcategory2_id' => 31, 'score' => 4],
            ['subcategory1_id' => 31, 'subcategory2_id' => 32, 'score' => 3],
            ['subcategory1_id' => 31, 'subcategory2_id' => 33, 'score' => 3],
            ['subcategory1_id' => 31, 'subcategory2_id' => 34, 'score' => 2],

            ['subcategory1_id' => 32, 'subcategory2_id' => 11, 'score' => 3],
            ['subcategory1_id' => 32, 'subcategory2_id' => 12, 'score' => 4],
            ['subcategory1_id' => 32, 'subcategory2_id' => 13, 'score' => 4],
            ['subcategory1_id' => 32, 'subcategory2_id' => 14, 'score' => 4],
            ['subcategory1_id' => 32, 'subcategory2_id' => 15, 'score' => 4],
            ['subcategory1_id' => 32, 'subcategory2_id' => 16, 'score' => 4],
            ['subcategory1_id' => 32, 'subcategory2_id' => 17, 'score' => 4],
            ['subcategory1_id' => 32, 'subcategory2_id' => 18, 'score' => 4],
            ['subcategory1_id' => 32, 'subcategory2_id' => 19, 'score' => 4],
            ['subcategory1_id' => 32, 'subcategory2_id' => 20, 'score' => 4],
            ['subcategory1_id' => 32, 'subcategory2_id' => 21, 'score' => 2],
            ['subcategory1_id' => 32, 'subcategory2_id' => 22, 'score' => 5],
            ['subcategory1_id' => 32, 'subcategory2_id' => 23, 'score' => 3],
            ['subcategory1_id' => 32, 'subcategory2_id' => 24, 'score' => 4],
            ['subcategory1_id' => 32, 'subcategory2_id' => 25, 'score' => 4],
            ['subcategory1_id' => 32, 'subcategory2_id' => 26, 'score' => 4],
            ['subcategory1_id' => 32, 'subcategory2_id' => 27, 'score' => 3],
            ['subcategory1_id' => 32, 'subcategory2_id' => 28, 'score' => 2],
            ['subcategory1_id' => 32, 'subcategory2_id' => 29, 'score' => 3],
            ['subcategory1_id' => 32, 'subcategory2_id' => 30, 'score' => 3],
            ['subcategory1_id' => 32, 'subcategory2_id' => 31, 'score' => 4],
            ['subcategory1_id' => 32, 'subcategory2_id' => 32, 'score' => 5],
            ['subcategory1_id' => 32, 'subcategory2_id' => 33, 'score' => 3],
            ['subcategory1_id' => 32, 'subcategory2_id' => 34, 'score' => 2],

            ['subcategory1_id' => 33, 'subcategory2_id' => 11, 'score' => 3],
            ['subcategory1_id' => 33, 'subcategory2_id' => 12, 'score' => 4],
            ['subcategory1_id' => 33, 'subcategory2_id' => 13, 'score' => 4],
            ['subcategory1_id' => 33, 'subcategory2_id' => 14, 'score' => 4],
            ['subcategory1_id' => 33, 'subcategory2_id' => 15, 'score' => 4],
            ['subcategory1_id' => 33, 'subcategory2_id' => 16, 'score' => 1],
            ['subcategory1_id' => 33, 'subcategory2_id' => 17, 'score' => 2],
            ['subcategory1_id' => 33, 'subcategory2_id' => 18, 'score' => 3],
            ['subcategory1_id' => 33, 'subcategory2_id' => 19, 'score' => 4],
            ['subcategory1_id' => 33, 'subcategory2_id' => 20, 'score' => 4],
            ['subcategory1_id' => 33, 'subcategory2_id' => 21, 'score' => 2],
            ['subcategory1_id' => 33, 'subcategory2_id' => 22, 'score' => 3],
            ['subcategory1_id' => 33, 'subcategory2_id' => 23, 'score' => 5],
            ['subcategory1_id' => 33, 'subcategory2_id' => 24, 'score' => 4],
            ['subcategory1_id' => 33, 'subcategory2_id' => 25, 'score' => 4],
            ['subcategory1_id' => 33, 'subcategory2_id' => 26, 'score' => 4],
            ['subcategory1_id' => 33, 'subcategory2_id' => 27, 'score' => 3],
            ['subcategory1_id' => 33, 'subcategory2_id' => 28, 'score' => 2],
            ['subcategory1_id' => 33, 'subcategory2_id' => 29, 'score' => 3],
            ['subcategory1_id' => 33, 'subcategory2_id' => 30, 'score' => 3],
            ['subcategory1_id' => 33, 'subcategory2_id' => 31, 'score' => 4],
            ['subcategory1_id' => 33, 'subcategory2_id' => 32, 'score' => 3],
            ['subcategory1_id' => 33, 'subcategory2_id' => 33, 'score' => 5],
            ['subcategory1_id' => 33, 'subcategory2_id' => 34, 'score' => 2],

            ['subcategory1_id' => 34, 'subcategory2_id' => 11, 'score' => 3],
            ['subcategory1_id' => 34, 'subcategory2_id' => 12, 'score' => 4],
            ['subcategory1_id' => 34, 'subcategory2_id' => 13, 'score' => 4],
            ['subcategory1_id' => 34, 'subcategory2_id' => 14, 'score' => 4],
            ['subcategory1_id' => 34, 'subcategory2_id' => 15, 'score' => 4],
            ['subcategory1_id' => 34, 'subcategory2_id' => 16, 'score' => 4],
            ['subcategory1_id' => 34, 'subcategory2_id' => 17, 'score' => 4],
            ['subcategory1_id' => 34, 'subcategory2_id' => 18, 'score' => 4],
            ['subcategory1_id' => 34, 'subcategory2_id' => 19, 'score' => 4],
            ['subcategory1_id' => 34, 'subcategory2_id' => 20, 'score' => 4],
            ['subcategory1_id' => 34, 'subcategory2_id' => 21, 'score' => 2],
            ['subcategory1_id' => 34, 'subcategory2_id' => 22, 'score' => 3],
            ['subcategory1_id' => 34, 'subcategory2_id' => 23, 'score' => 2],
            ['subcategory1_id' => 34, 'subcategory2_id' => 24, 'score' => 5],
            ['subcategory1_id' => 34, 'subcategory2_id' => 25, 'score' => 4],
            ['subcategory1_id' => 34, 'subcategory2_id' => 26, 'score' => 4],
            ['subcategory1_id' => 34, 'subcategory2_id' => 27, 'score' => 3],
            ['subcategory1_id' => 34, 'subcategory2_id' => 28, 'score' => 2],
            ['subcategory1_id' => 34, 'subcategory2_id' => 29, 'score' => 3],
            ['subcategory1_id' => 34, 'subcategory2_id' => 30, 'score' => 3],
            ['subcategory1_id' => 34, 'subcategory2_id' => 31, 'score' => 4],
            ['subcategory1_id' => 34, 'subcategory2_id' => 32, 'score' => 3],
            ['subcategory1_id' => 34, 'subcategory2_id' => 33, 'score' => 3],
            ['subcategory1_id' => 34, 'subcategory2_id' => 34, 'score' => 5],

                    // Baris 1 - E-government (subcategory1_id = 35)
            ['subcategory1_id' => 35, 'subcategory2_id' => 35, 'score' => 5],
            ['subcategory1_id' => 35, 'subcategory2_id' => 36, 'score' => 1],
            ['subcategory1_id' => 35, 'subcategory2_id' => 37, 'score' => 4],
            ['subcategory1_id' => 35, 'subcategory2_id' => 38, 'score' => 4],
            ['subcategory1_id' => 35, 'subcategory2_id' => 39, 'score' => 4],
            ['subcategory1_id' => 35, 'subcategory2_id' => 40, 'score' => 4],
            ['subcategory1_id' => 35, 'subcategory2_id' => 41, 'score' => 4],
            ['subcategory1_id' => 35, 'subcategory2_id' => 42, 'score' => 3],
            ['subcategory1_id' => 35, 'subcategory2_id' => 43, 'score' => 3],
            ['subcategory1_id' => 35, 'subcategory2_id' => 44, 'score' => 2],
            ['subcategory1_id' => 35, 'subcategory2_id' => 45, 'score' => 1],
            ['subcategory1_id' => 35, 'subcategory2_id' => 46, 'score' => 3],
            ['subcategory1_id' => 35, 'subcategory2_id' => 47, 'score' => 3],

            ['subcategory1_id' => 36, 'subcategory2_id' => 35, 'score' => 2],
            ['subcategory1_id' => 36, 'subcategory2_id' => 36, 'score' => 5],
            ['subcategory1_id' => 36, 'subcategory2_id' => 37, 'score' => 4],
            ['subcategory1_id' => 36, 'subcategory2_id' => 38, 'score' => 4],
            ['subcategory1_id' => 36, 'subcategory2_id' => 39, 'score' => 3],
            ['subcategory1_id' => 36, 'subcategory2_id' => 40, 'score' => 4],
            ['subcategory1_id' => 36, 'subcategory2_id' => 41, 'score' => 4],
            ['subcategory1_id' => 36, 'subcategory2_id' => 42, 'score' => 3],
            ['subcategory1_id' => 36, 'subcategory2_id' => 43, 'score' => 2],
            ['subcategory1_id' => 36, 'subcategory2_id' => 44, 'score' => 2],
            ['subcategory1_id' => 36, 'subcategory2_id' => 45, 'score' => 1],
            ['subcategory1_id' => 36, 'subcategory2_id' => 46, 'score' => 4],
            ['subcategory1_id' => 36, 'subcategory2_id' => 47, 'score' => 3],

            ['subcategory1_id' => 37, 'subcategory2_id' => 35, 'score' => 4],
    ['subcategory1_id' => 37, 'subcategory2_id' => 36, 'score' => 4],
    ['subcategory1_id' => 37, 'subcategory2_id' => 37, 'score' => 5],
    ['subcategory1_id' => 37, 'subcategory2_id' => 38, 'score' => 5],
    ['subcategory1_id' => 37, 'subcategory2_id' => 39, 'score' => 4],
    ['subcategory1_id' => 37, 'subcategory2_id' => 40, 'score' => 4],
    ['subcategory1_id' => 37, 'subcategory2_id' => 41, 'score' => 4],
    ['subcategory1_id' => 37, 'subcategory2_id' => 42, 'score' => 2],
    ['subcategory1_id' => 37, 'subcategory2_id' => 43, 'score' => 2],
    ['subcategory1_id' => 37, 'subcategory2_id' => 44, 'score' => 2],
    ['subcategory1_id' => 37, 'subcategory2_id' => 45, 'score' => 1],
    ['subcategory1_id' => 37, 'subcategory2_id' => 46, 'score' => 4],
    ['subcategory1_id' => 37, 'subcategory2_id' => 47, 'score' => 4],

    ['subcategory1_id' => 38, 'subcategory2_id' => 35, 'score' => 4],
    ['subcategory1_id' => 38, 'subcategory2_id' => 36, 'score' => 4],
    ['subcategory1_id' => 38, 'subcategory2_id' => 37, 'score' => 4],
    ['subcategory1_id' => 38, 'subcategory2_id' => 38, 'score' => 5],
    ['subcategory1_id' => 38, 'subcategory2_id' => 39, 'score' => 4],
    ['subcategory1_id' => 38, 'subcategory2_id' => 40, 'score' => 5],
    ['subcategory1_id' => 38, 'subcategory2_id' => 41, 'score' => 5],
    ['subcategory1_id' => 38, 'subcategory2_id' => 42, 'score' => 3],
    ['subcategory1_id' => 38, 'subcategory2_id' => 43, 'score' => 2],
    ['subcategory1_id' => 38, 'subcategory2_id' => 44, 'score' => 2],
    ['subcategory1_id' => 38, 'subcategory2_id' => 45, 'score' => 2],
    ['subcategory1_id' => 38, 'subcategory2_id' => 46, 'score' => 4],
    ['subcategory1_id' => 38, 'subcategory2_id' => 47, 'score' => 3],

    ['subcategory1_id' => 39, 'subcategory2_id' => 35, 'score' => 4],
    ['subcategory1_id' => 39, 'subcategory2_id' => 36, 'score' => 3],
    ['subcategory1_id' => 39, 'subcategory2_id' => 37, 'score' => 4],
    ['subcategory1_id' => 39, 'subcategory2_id' => 38, 'score' => 4],
    ['subcategory1_id' => 39, 'subcategory2_id' => 39, 'score' => 5],
    ['subcategory1_id' => 39, 'subcategory2_id' => 40, 'score' => 4],
    ['subcategory1_id' => 39, 'subcategory2_id' => 41, 'score' => 4],
    ['subcategory1_id' => 39, 'subcategory2_id' => 42, 'score' => 2],
    ['subcategory1_id' => 39, 'subcategory2_id' => 43, 'score' => 3],
    ['subcategory1_id' => 39, 'subcategory2_id' => 44, 'score' => 1],
    ['subcategory1_id' => 39, 'subcategory2_id' => 45, 'score' => 2],
    ['subcategory1_id' => 39, 'subcategory2_id' => 46, 'score' => 4],
    ['subcategory1_id' => 39, 'subcategory2_id' => 47, 'score' => 4],

    // Baris 6 - Web programming (subcategory1_id = 40)
    ['subcategory1_id' => 40, 'subcategory2_id' => 35, 'score' => 4],
    ['subcategory1_id' => 40, 'subcategory2_id' => 36, 'score' => 4],
    ['subcategory1_id' => 40, 'subcategory2_id' => 37, 'score' => 4],
    ['subcategory1_id' => 40, 'subcategory2_id' => 38, 'score' => 4],
    ['subcategory1_id' => 40, 'subcategory2_id' => 39, 'score' => 4],
    ['subcategory1_id' => 40, 'subcategory2_id' => 40, 'score' => 5],
    ['subcategory1_id' => 40, 'subcategory2_id' => 41, 'score' => 4],
    ['subcategory1_id' => 40, 'subcategory2_id' => 42, 'score' => 3],
    ['subcategory1_id' => 40, 'subcategory2_id' => 43, 'score' => 3],
    ['subcategory1_id' => 40, 'subcategory2_id' => 44, 'score' => 2],
    ['subcategory1_id' => 40, 'subcategory2_id' => 45, 'score' => 2],
    ['subcategory1_id' => 40, 'subcategory2_id' => 46, 'score' => 4],
    ['subcategory1_id' => 40, 'subcategory2_id' => 47, 'score' => 3],

    // Baris 7 - Embedded system (subcategory1_id = 41)
    ['subcategory1_id' => 41, 'subcategory2_id' => 35, 'score' => 3],
    ['subcategory1_id' => 41, 'subcategory2_id' => 36, 'score' => 4],
    ['subcategory1_id' => 41, 'subcategory2_id' => 37, 'score' => 4],
    ['subcategory1_id' => 41, 'subcategory2_id' => 38, 'score' => 4],
    ['subcategory1_id' => 41, 'subcategory2_id' => 39, 'score' => 2],
    ['subcategory1_id' => 41, 'subcategory2_id' => 40, 'score' => 4],
    ['subcategory1_id' => 41, 'subcategory2_id' => 41, 'score' => 5],
    ['subcategory1_id' => 41, 'subcategory2_id' => 42, 'score' => 5],
    ['subcategory1_id' => 41, 'subcategory2_id' => 43, 'score' => 3],
    ['subcategory1_id' => 41, 'subcategory2_id' => 44, 'score' => 2],
    ['subcategory1_id' => 41, 'subcategory2_id' => 45, 'score' => 2],
    ['subcategory1_id' => 41, 'subcategory2_id' => 46, 'score' => 4],
    ['subcategory1_id' => 41, 'subcategory2_id' => 47, 'score' => 4],

    // Baris 8 - Multimedia (subcategory1_id = 42)
    ['subcategory1_id' => 42, 'subcategory2_id' => 35, 'score' => 3],
    ['subcategory1_id' => 42, 'subcategory2_id' => 36, 'score' => 4],
    ['subcategory1_id' => 42, 'subcategory2_id' => 37, 'score' => 4],
    ['subcategory1_id' => 42, 'subcategory2_id' => 38, 'score' => 4],
    ['subcategory1_id' => 42, 'subcategory2_id' => 39, 'score' => 3],
    ['subcategory1_id' => 42, 'subcategory2_id' => 40, 'score' => 3],
    ['subcategory1_id' => 42, 'subcategory2_id' => 41, 'score' => 4],
    ['subcategory1_id' => 42, 'subcategory2_id' => 42, 'score' => 5],
    ['subcategory1_id' => 42, 'subcategory2_id' => 43, 'score' => 3],
    ['subcategory1_id' => 42, 'subcategory2_id' => 44, 'score' => 2],
    ['subcategory1_id' => 42, 'subcategory2_id' => 45, 'score' => 2],
    ['subcategory1_id' => 42, 'subcategory2_id' => 46, 'score' => 4],
    ['subcategory1_id' => 42, 'subcategory2_id' => 47, 'score' => 4],

    ['subcategory1_id' => 43, 'subcategory2_id' => 35, 'score' => 4],
    ['subcategory1_id' => 43, 'subcategory2_id' => 36, 'score' => 4],
    ['subcategory1_id' => 43, 'subcategory2_id' => 37, 'score' => 4],
    ['subcategory1_id' => 43, 'subcategory2_id' => 38, 'score' => 4],
    ['subcategory1_id' => 43, 'subcategory2_id' => 39, 'score' => 4],
    ['subcategory1_id' => 43, 'subcategory2_id' => 40, 'score' => 5],
    ['subcategory1_id' => 43, 'subcategory2_id' => 41, 'score' => 4],
    ['subcategory1_id' => 43, 'subcategory2_id' => 42, 'score' => 3],
    ['subcategory1_id' => 43, 'subcategory2_id' => 43, 'score' => 3],
    ['subcategory1_id' => 43, 'subcategory2_id' => 44, 'score' => 2],
    ['subcategory1_id' => 43, 'subcategory2_id' => 45, 'score' => 2],
    ['subcategory1_id' => 43, 'subcategory2_id' => 46, 'score' => 4],
    ['subcategory1_id' => 43, 'subcategory2_id' => 47, 'score' => 3],

    ['subcategory1_id' => 44, 'subcategory2_id' => 35, 'score' => 4],
    ['subcategory1_id' => 44, 'subcategory2_id' => 36, 'score' => 4],
    ['subcategory1_id' => 44, 'subcategory2_id' => 37, 'score' => 4],
    ['subcategory1_id' => 44, 'subcategory2_id' => 38, 'score' => 4],
    ['subcategory1_id' => 44, 'subcategory2_id' => 39, 'score' => 4],
    ['subcategory1_id' => 44, 'subcategory2_id' => 40, 'score' => 5],
    ['subcategory1_id' => 44, 'subcategory2_id' => 41, 'score' => 4],
    ['subcategory1_id' => 44, 'subcategory2_id' => 42, 'score' => 3],
    ['subcategory1_id' => 44, 'subcategory2_id' => 43, 'score' => 3],
    ['subcategory1_id' => 44, 'subcategory2_id' => 44, 'score' => 2],
    ['subcategory1_id' => 44, 'subcategory2_id' => 45, 'score' => 2],
    ['subcategory1_id' => 44, 'subcategory2_id' => 46, 'score' => 4],
    ['subcategory1_id' => 44, 'subcategory2_id' => 47, 'score' => 3],

    ['subcategory1_id' => 45, 'subcategory2_id' => 35, 'score' => 4],
    ['subcategory1_id' => 45, 'subcategory2_id' => 36, 'score' => 4],
    ['subcategory1_id' => 45, 'subcategory2_id' => 37, 'score' => 4],
    ['subcategory1_id' => 45, 'subcategory2_id' => 38, 'score' => 4],
    ['subcategory1_id' => 45, 'subcategory2_id' => 39, 'score' => 4],
    ['subcategory1_id' => 45, 'subcategory2_id' => 40, 'score' => 5],
    ['subcategory1_id' => 45, 'subcategory2_id' => 41, 'score' => 4],
    ['subcategory1_id' => 45, 'subcategory2_id' => 42, 'score' => 3],
    ['subcategory1_id' => 45, 'subcategory2_id' => 43, 'score' => 3],
    ['subcategory1_id' => 45, 'subcategory2_id' => 44, 'score' => 2],
    ['subcategory1_id' => 45, 'subcategory2_id' => 45, 'score' => 2],
    ['subcategory1_id' => 45, 'subcategory2_id' => 46, 'score' => 4],
    ['subcategory1_id' => 45, 'subcategory2_id' => 47, 'score' => 3],

    ['subcategory1_id' => 46, 'subcategory2_id' => 35, 'score' => 4],
    ['subcategory1_id' => 46, 'subcategory2_id' => 36, 'score' => 4],
    ['subcategory1_id' => 46, 'subcategory2_id' => 37, 'score' => 4],
    ['subcategory1_id' => 46, 'subcategory2_id' => 38, 'score' => 4],
    ['subcategory1_id' => 46, 'subcategory2_id' => 39, 'score' => 4],
    ['subcategory1_id' => 46, 'subcategory2_id' => 40, 'score' => 5],
    ['subcategory1_id' => 46, 'subcategory2_id' => 41, 'score' => 4],
    ['subcategory1_id' => 46, 'subcategory2_id' => 42, 'score' => 3],
    ['subcategory1_id' => 46, 'subcategory2_id' => 43, 'score' => 3],
    ['subcategory1_id' => 46, 'subcategory2_id' => 44, 'score' => 2],
    ['subcategory1_id' => 46, 'subcategory2_id' => 45, 'score' => 2],
    ['subcategory1_id' => 46, 'subcategory2_id' => 46, 'score' => 4],
    ['subcategory1_id' => 46, 'subcategory2_id' => 47, 'score' => 3],

    ['subcategory1_id' => 47, 'subcategory2_id' => 35, 'score' => 4],
    ['subcategory1_id' => 47, 'subcategory2_id' => 36, 'score' => 4],
    ['subcategory1_id' => 47, 'subcategory2_id' => 37, 'score' => 4],
    ['subcategory1_id' => 47, 'subcategory2_id' => 38, 'score' => 4],
    ['subcategory1_id' => 47, 'subcategory2_id' => 39, 'score' => 4],
    ['subcategory1_id' => 47, 'subcategory2_id' => 40, 'score' => 5],
    ['subcategory1_id' => 47, 'subcategory2_id' => 41, 'score' => 4],
    ['subcategory1_id' => 47, 'subcategory2_id' => 42, 'score' => 3],
    ['subcategory1_id' => 47, 'subcategory2_id' => 43, 'score' => 3],
    ['subcategory1_id' => 47, 'subcategory2_id' => 44, 'score' => 2],
    ['subcategory1_id' => 47, 'subcategory2_id' => 45, 'score' => 2],
    ['subcategory1_id' => 47, 'subcategory2_id' => 46, 'score' => 4],
    ['subcategory1_id' => 47, 'subcategory2_id' => 47, 'score' => 3],

    ['subcategory1_id' => 48, 'subcategory2_id' => 48, 'score' => 5],
    ['subcategory1_id' => 48, 'subcategory2_id' => 49, 'score' => 4],
    ['subcategory1_id' => 48, 'subcategory2_id' => 50, 'score' => 2],
    ['subcategory1_id' => 48, 'subcategory2_id' => 51, 'score' => 3],
    ['subcategory1_id' => 48, 'subcategory2_id' => 52, 'score' => 3],


    ['subcategory1_id' => 49, 'subcategory2_id' => 48, 'score' => 3],
    ['subcategory1_id' => 49, 'subcategory2_id' => 49, 'score' => 5],
    ['subcategory1_id' => 49, 'subcategory2_id' => 50, 'score' => 2],
    ['subcategory1_id' => 49, 'subcategory2_id' => 51, 'score' => 4],
    ['subcategory1_id' => 49, 'subcategory2_id' => 52, 'score' => 3],

    ['subcategory1_id' => 50, 'subcategory2_id' => 48, 'score' => 2],
    ['subcategory1_id' => 50, 'subcategory2_id' => 49, 'score' => 3],
    ['subcategory1_id' => 50, 'subcategory2_id' => 50, 'score' => 5],
    ['subcategory1_id' => 50, 'subcategory2_id' => 51, 'score' => 4],
    ['subcategory1_id' => 50, 'subcategory2_id' => 52, 'score' => 3],

    ['subcategory1_id' => 51, 'subcategory2_id' => 48, 'score' => 2],
    ['subcategory1_id' => 51, 'subcategory2_id' => 49, 'score' => 3],
    ['subcategory1_id' => 51, 'subcategory2_id' => 50, 'score' => 3],
    ['subcategory1_id' => 51, 'subcategory2_id' => 51, 'score' => 5],
    ['subcategory1_id' => 51, 'subcategory2_id' => 52, 'score' => 4],

    ['subcategory1_id' => 52, 'subcategory2_id' => 48, 'score' => 2],
    ['subcategory1_id' => 52, 'subcategory2_id' => 49, 'score' => 3],
    ['subcategory1_id' => 52, 'subcategory2_id' => 50, 'score' => 2],
    ['subcategory1_id' => 52, 'subcategory2_id' => 51, 'score' => 4],
    ['subcategory1_id' => 52, 'subcategory2_id' => 52, 'score' => 5],
];


foreach ($relations as $relation) {
    SubcategoryRelation::create($relation);
}


    // User::factory(10)->create();


// $new_user = User::create([
            //     'user_id' =>3,
        //     'username' => 'fajry',
        //     'password' => Hash::make('fajry'),
        //     'nama_lengkap' => 'Administrator',
        //     'role_id' => 1,
        //     'is_password' => 'admin123',
        //     'jenis_kelamin' => 'Laki-laki',
        //     'alamat' => 'Jl. Jend. Sudirman No. 1',
        //     'image' => '1721232634.jpeg',

        // ]);

        // $new_user->save();

        // Membuat Kategori untuk Kategori 1
        // $kategori1 = Kategori::create(['kategori' => 'Kategori 1', 'subkategori' => 'Komputer']);
        // $kategori2 = Kategori::create(['kategori' => 'Kategori 1', 'subkategori' => 'E-government']);
        // $kategori3 = Kategori::create(['kategori' => 'Kategori 1', 'subkategori' => 'Web programming']);
        // $kategori4 = Kategori::create(['kategori' => 'Kategori 1', 'subkategori' => 'Sistem pendukung keputusan']);
        // $kategori5 = Kategori::create(['kategori' => 'Kategori 1', 'subkategori' => 'Multimedia']);
        // $kategori6 = Kategori::create(['kategori' => 'Kategori 1', 'subkategori' => 'Embedded system']);
        // $kategori7 = Kategori::create(['kategori' => 'Kategori 1', 'subkategori' => 'Pemrograman']);
        // $kategori8 = Kategori::create(['kategori' => 'Kategori 1', 'subkategori' => 'Manajemen telekomunikasi']);
        // $kategori9 = Kategori::create(['kategori' => 'Kategori 1', 'subkategori' => 'Teknik informatika']);
        // $kategori10 = Kategori::create(['kategori' => 'Kategori 1', 'subkategori' => 'Sistem informasi']);

        // // Membuat Kategori untuk Kategori 2
        // $kategori11 = Kategori::create(['kategori' => 'Kategori 2', 'subkategori' => 'E-commerce']);
        // $kategori12 = Kategori::create(['kategori' => 'Kategori 2', 'subkategori' => 'E-government']);
        // $kategori13 = Kategori::create(['kategori' => 'Kategori 2', 'subkategori' => 'Sistem informasi manajemen']);
        // $kategori14 = Kategori::create(['kategori' => 'Kategori 2', 'subkategori' => 'Metodologi penelitian']);
        // $kategori15 = Kategori::create(['kategori' => 'Kategori 2', 'subkategori' => 'Hukum dan etika teknologi informasi']);
        // $kategori16 = Kategori::create(['kategori' => 'Kategori 2', 'subkategori' => 'Teknologi web']);
        // $kategori17 = Kategori::create(['kategori' => 'Kategori 2', 'subkategori' => 'Teknologi basis data']);
        // $kategori18 = Kategori::create(['kategori' => 'Kategori 2', 'subkategori' => 'Pemrograman web']);
        // $kategori19 = Kategori::create(['kategori' => 'Kategori 2', 'subkategori' => 'Bahasa kueri terstruktur']);
        // $kategori20 = Kategori::create(['kategori' => 'Kategori 2', 'subkategori' => 'Media sosial dan periklanan']);
        // $kategori21 = Kategori::create(['kategori' => 'Kategori 2', 'subkategori' => 'Algoritma dan pemrograman']);
        // $kategori22 = Kategori::create(['kategori' => 'Kategori 2', 'subkategori' => 'Struktur data']);
        // $kategori23 = Kategori::create(['kategori' => 'Kategori 2', 'subkategori' => 'Jaringan komputer dan komunikasi data']);
        // $kategori24 = Kategori::create(['kategori' => 'Kategori 2', 'subkategori' => '3D object modelling']);
        // $kategori25 = Kategori::create(['kategori' => 'Kategori 2', 'subkategori' => '3D animation']);
        // $kategori26 = Kategori::create(['kategori' => 'Kategori 2', 'subkategori' => 'Arsitektur teknologi informasi']);
        // $kategori27 = Kategori::create(['kategori' => 'Kategori 2', 'subkategori' => 'Teknologi immersive']);
        // $kategori28 = Kategori::create(['kategori' => 'Kategori 2', 'subkategori' => 'Teknologi jaringan nirkabel']);
        // $kategori29 = Kategori::create(['kategori' => 'Kategori 2', 'subkategori' => 'Design grafis berbasis vector']);
        // $kategori30 = Kategori::create(['kategori' => 'Kategori 2', 'subkategori' => 'Teknologi cloud computing']);
        // $kategori31 = Kategori::create(['kategori' => 'Kategori 2', 'subkategori' => 'Decision support system']);
        // $kategori32 = Kategori::create(['kategori' => 'Kategori 2', 'subkategori' => 'Manajemen big data']);
        // $kategori33 = Kategori::create(['kategori' => 'Kategori 2', 'subkategori' => 'Pemrograman berorientasi objek']);
        // $kategori34 = Kategori::create(['kategori' => 'Kategori 2', 'subkategori' => 'Interaksi manusia dan komputer']);

        // // Membuat Kategori untuk Kategori 3
        // $kategori35 = Kategori::create(['kategori' => 'Kategori 3', 'subkategori' => 'E-government']);
        // $kategori36 = Kategori::create(['kategori' => 'Kategori 3', 'subkategori' => 'E-commerce']);
        // $kategori37 = Kategori::create(['kategori' => 'Kategori 3', 'subkategori' => 'Data mining']);
        // $kategori38 = Kategori::create(['kategori' => 'Kategori 3', 'subkategori' => 'Literasi digital']);
        // $kategori39 = Kategori::create(['kategori' => 'Kategori 3', 'subkategori' => 'Teknologi informasi']);
        // $kategori40 = Kategori::create(['kategori' => 'Kategori 3', 'subkategori' => 'Web programming']);
        // $kategori41 = Kategori::create(['kategori' => 'Kategori 3', 'subkategori' => 'Embedded system']);
        // $kategori42 = Kategori::create(['kategori' => 'Kategori 3', 'subkategori' => 'Multimedia']);
        // $kategori43 = Kategori::create(['kategori' => 'Kategori 3', 'subkategori' => 'Game']);
        // $kategori44 = Kategori::create(['kategori' => 'Kategori 3', 'subkategori' => 'Animasi']);
        // $kategori45 = Kategori::create(['kategori' => 'Kategori 3', 'subkategori' => 'Design grafis']);
        // $kategori46 = Kategori::create(['kategori' => 'Kategori 3', 'subkategori' => 'Artificial Intelligence']);
        // $kategori47 = Kategori::create(['kategori' => 'Kategori 3', 'subkategori' => 'Teknologi tepat guna']);

        // // Membuat Kategori untuk Kategori 4
        // $kategori48 = Kategori::create(['kategori' => 'Kategori 4', 'subkategori' => 'Seminar etika berteknologi']);
        // $kategori49 = Kategori::create(['kategori' => 'Kategori 4', 'subkategori' => 'KKN literasi digital']);
        // $kategori50 = Kategori::create(['kategori' => 'Kategori 4', 'subkategori' => 'Pembimbing olimpiade informatika']);
        // $kategori51 = Kategori::create(['kategori' => 'Kategori 4', 'subkategori' => 'Pengabdian tentang teknologi multimedia']);
        // $kategori52 = Kategori::create(['kategori' => 'Kategori 4', 'subkategori' => 'Pengabdian teknologi tepat guna']);

        // // Mengambil dosen yang sudah ada
        // $dosen1 = Dosen::where('nama_dosen', 'Muh. Fadli Fauzi Sahlan S.Pd.,M.Kom.')->first();
        // $dosen2 = Dosen::where('nama_dosen', 'Abdillah SAS, S.Kom.,M.Pd.')->first();
        // $dosen3 = Dosen::where('nama_dosen', 'Supriadi Syam S.Kom.,M.Kom.')->first();
        // $dosen4 = Dosen::where('nama_dosen', 'Arief Fauzan S.Kom.,M.T.')->first();
        // $dosen5 = Dosen::where('nama_dosen', 'Sudirman S.Kom.,M.Msi.,M.Kom.')->first();

        // // Relasi untuk Muh. Fadli Fauzi Sahlan S.Pd.,M.Kom.
        // if ($dosen1) {
        //     $dosen1->kategoris()->attach([
        //         $kategori1->id, // Komputer
        //         $kategori2->id, // E-government
        //         $kategori11->id, // E-commerce
        //         $kategori12->id, // E-government
        //         $kategori13->id, // Sistem informasi manajemen
        //         $kategori14->id, // Metodologi penelitian
        //         $kategori15->id, // Hukum dan etika teknologi informasi
        //         $kategori35->id, // E-government (kategori 3)
        //         $kategori36->id, // E-commerce (kategori 3)
        //         $kategori37->id, // Data mining
        //         $kategori48->id, // Seminar etika berteknologi
        //     ]);
        // }

        // // Relasi untuk Abdillah SAS, S.Kom.,M.Pd.
        // if ($dosen2) {
        //     $dosen2->kategoris()->attach([
        //         $kategori3->id,  // Web programming
        //         $kategori4->id,  // Sistem pendukung keputusan
        //         $kategori16->id, // Teknologi web
        //         $kategori17->id, // Teknologi basis data
        //         $kategori18->id, // Pemrograman web
        //         $kategori19->id, // Bahasa kueri terstruktur
        //         $kategori20->id, // Media sosial dan periklanan
        //         $kategori38->id, // Literasi digital
        //         $kategori39->id, // Teknologi informasi
        //         $kategori40->id, // Web programming (kategori 3)
        //         $kategori49->id, // KKN literasi digital
        //     ]);
        // }

        // // Relasi untuk Supriadi Syam S.Kom.,M.Kom.
        // if ($dosen3) {
        //     $dosen3->kategoris()->attach([
        //         $kategori21->id, // Algoritma dan pemrograman
        //         $kategori22->id, // Struktur data
        //         $kategori23->id, // Jaringan komputer dan komunikasi data
        //         $kategori24->id, // 3D object modelling
        //         $kategori25->id, // 3D animation
        //         $kategori5->id,  // Multimedia
        //         $kategori6->id,  // Embedded system
        //         $kategori50->id, // Pembimbing olimpiade informatika
        //     ]);
        // }

        // // Relasi untuk Arief Fauzan S.Kom.,M.T.
        // if ($dosen4) {
        //     $dosen4->kategoris()->attach([
        //         $kategori7->id,  // Pemrograman
        //         $kategori8->id,  // Manajemen telekomunikasi
        //         $kategori26->id, // Arsitektur teknologi informasi
        //         $kategori27->id, // Teknologi immersive
        //         $kategori28->id, // Teknologi jaringan nirkabel
        //         $kategori29->id, // Design grafis berbasis vector
        //         $kategori43->id, // Game
        //         $kategori44->id, // Animasi
        //         $kategori45->id, // Design grafis
        //         $kategori51->id, // Pengabdian tentang teknologi multimedia
        //     ]);
        // }

        // // Relasi untuk Sudirman S.Kom.,M.Msi.,M.Kom.
        // if ($dosen5) {
        //     $dosen5->kategoris()->attach([
        //         $kategori9->id,  // Teknik informatika
        //         $kategori10->id, // Sistem informasi
        //         $kategori30->id, // Teknologi cloud computing
        //         $kategori31->id, // Decision support system
        //         $kategori32->id, // Manajemen big data
        //         $kategori33->id, // Pemrograman berorientasi objek
        //         $kategori34->id, // Interaksi manusia dan komputer
        //         $kategori46->id, // Artificial Intelligence
        //         $kategori47->id, // Teknologi tepat guna
        //         $kategori52->id, // Pengabdian teknologi tepat guna
        //     ]);
        // }

    }
}
