<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    private $authors = [
        [
            'id' => 1,
            'name' => 'George Orwell',
            'negara' => 'UK'
        ],
        [
            'id' => 2,
            'name' => 'J.K. Rowling',
            'negara' => 'UK' 
        ],[
            'id' => 3,
            'name' => 'Haruki Murakami',
            'negara' => 'Jepang' 
        ],[
            'id' => 4,
            'name' => 'Mark Twain',
            'negara' => 'USA' 
        ],[
            'id' => 5,
            'name' => 'Jane Austen',
            'negara' => 'UK' 
        ],
    ];

    public function getAuthors() {
        return $this->authors;
    }
}

