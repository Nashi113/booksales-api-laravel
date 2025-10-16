<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create([
            'name' => 'Pulang',
            'description' => 'Petualangan seorang pemuda yang kembali ke desa kelahirannya.',
            'price' => 40000,
            'stock' => 15,
        ]);

        Book::create([
            'name' => 'Merantau',
            'description' => 'Petualangan seorang pemuda yang merantau ke kota.',
            'price' => 45000,
            'stock' => 20,
        ]);

        Book::create([
            'name' => 'Memancing',
            'description' => 'Petualangan seorang pemuda yang memancing di danau angker.',
            'price' => 100000,
            'stock' => 41,
        ]);

        Book::create([
            'name' => 'Bekerja, Bekerja, Bekerja',
            'description' => 'Petualangan seorang pemuda yang sangat giat bekerja.',
            'price' => 50000,
            'stock' => 10,
        ]);

        Book::create([
            'name' => 'Pengangguran',
            'description' => 'Petualangan seorang pemuda yang sedang menunggu 19juta lapangan pekerjaan.',
            'price' => 19000,
            'stock' => 100,
        ]);
    }
}
