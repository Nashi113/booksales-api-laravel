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
            'cover_photo' => 'pulang.jpg',
            'genre_id' => 1,
            'author_id' => 1
        ]);

        Book::create([
            'name' => 'Merantau',
            'description' => 'Petualangan seorang pemuda yang merantau ke kota.',
            'price' => 45000,
            'stock' => 20,
            'cover_photo' => 'merantau.jpg',
            'genre_id' => 1,
            'author_id' => 3
        ]);

        Book::create([
            'name' => 'Memancing',
            'description' => 'Petualangan seorang pemuda yang memancing di danau angker.',
            'price' => 100000,
            'stock' => 41,
            'cover_photo' => 'memancing.jpg',
            'genre_id' => 1,
            'author_id' => 2
        ]);

        Book::create([
            'name' => 'Bekerja, Bekerja, Bekerja',
            'description' => 'Petualangan seorang pemuda yang sangat giat bekerja.',
            'price' => 50000,
            'stock' => 10,
            'cover_photo' => 'bekerja.jpg',
            'genre_id' => 2,
            'author_id' => 4
        ]);

        Book::create([
            'name' => 'Pengangguran',
            'description' => 'Petualangan seorang pemuda yang sedang menunggu 19juta lapangan pekerjaan.',
            'price' => 19000,
            'stock' => 100,
            'cover_photo' => 'pengangguran.jpg',
            'genre_id' => 2,
            'author_id' => 5
        ]);
    }
}
