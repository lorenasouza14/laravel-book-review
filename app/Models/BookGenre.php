<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookGenre extends Model
{
    protected $table = 'book_genres';
    protected $fillable = ['name'];

    public function books()
    {
        return $this->hasMany(Book::class, 'genre_id', 'id');
    }
}

