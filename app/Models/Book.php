<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    private $books = [
        [
            'title' => 'Pulang',
            'description' => 'Petualangan seorang pemuda yang kembali ke desa kelahirannya.',
            'price' => 40000,
            'stock' => 15,
            'cover_photo' => 'pulang.jpg',
            'genre_id' => 1,
            'author_id' => 1
        ],
        [
            'title' => 'Merantau',
            'description' => 'Petualangan seorang pemuda yang merantau ke kota.',
            'price' => 30000,
            'stock' => 11,
            'cover_photo' => 'merantau.jpg',
            'genre_id' => 1,
            'author_id' => 4
        ],
        [
            'title' => 'Memancing',
            'description' => 'Petualangan seorang pemuda yang memancing di danau angker.',
            'price' => 45000,
            'stock' => 20,
            'cover_photo' => 'mancing.jpg',
            'genre_id' => 2,
            'author_id' => 2
        ],
        [
            'title' => 'Bekerja, Bekerja, Bekerja',
            'description' => 'Petualangan seorang pemuda yang sangat giat bekerja.',
            'price' => 50000,
            'stock' => 20,
            'cover_photo' => 'bekerja.jpg',
            'genre_id' => 4,
            'author_id' => 5
        ],
        [
            'title' => 'Pengangguran',
            'description' => 'Petualangan seorang pemuda yang sedang menunggu 19juta lapangan pekerjaan.',
            'price' => 100000,
            'stock' => 19,
            'cover_photo' => 'pengangguran.jpg',
            'genre_id' => 2,
            'author_id' => 5
        ],
    ];
    public function getBooks() {
        return $this->books;
    }
}
