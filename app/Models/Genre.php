<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    private $genres = [
        [
            'id' => 1,
            'name' => 'Petualangan', 
        ],
        [
            'id' => 2,
            'name' => 'Horror', 
        ],[
            'id' => 3,
            'name' => 'Fiksi', 
        ],[
            'id' => 4,
            'name' => 'Motivasi', 
        ],[
            'id' => 5,
            'name' => 'History', 
        ],
    ];

    public function getGenres() {
        return $this->genres;
    }
}
