<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'name' => 'George Orwell',
            'negara' => 'UK',
        ]);

        Author::create([
            'name' => 'J.K. Rowling',
            'negara' => 'UK',
        ]);

        Author::create([
            'name' => 'Haruki Murakami',
            'negara' => 'Jepang',
        ]);

        Author::create([
            'name' => 'Mark Twain',
            'negara' => 'USA',
        ]);

        Author::create([
            'name' => 'Jane Austen',
            'negara' => 'UK',
        ]);
    }
}
