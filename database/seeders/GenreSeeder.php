<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Genre::create([
            'name' => 'Petualangan', 
            'description' => 'Genre yang menekankan pada keseruan'
        ]);

         Genre::create([
            'name' => 'Horror', 
            'description' => 'Genre yang bertujuan untuk membangkitkan rasa takut, teror, atau kegelisahan pada pembaca/penonton. Sering melibatkan unsur-unsur supranatural, makhluk mengerikan, atau kejahatan sadis.'
        ]);
        
        Genre::create([
            'name' => 'Fiksi', 
            'description' => 'Karya naratif yang alur cerita, tokoh, dan latarnya merupakan hasil khayalan atau rekaan penulis, bukan berdasarkan fakta nyata yang benar-benar terjadi.'
        ]);
        
        Genre::create([
            'name' => 'Motivasi', 
            'description' => 'Genre (biasanya non-fiksi) yang isinya bertujuan untuk menginspirasi, mendorong, dan memberikan semangat kepada pembaca/pendengar untuk mencapai tujuan atau meningkatkan kualitas diri.'
        ]);

         Genre::create([
            'name' => 'Histori', 
            'description' => 'Genre (bisa fiksi atau non-fiksi) yang berlatar belakang atau menceritakan peristiwa-peristiwa, tokoh, atau masa lalu yang benar-benar terjadi (jika non-fiksi) atau yang diangkat dari fakta sejarah (jika fiksi sejarah).'
        ]);
    }
}
