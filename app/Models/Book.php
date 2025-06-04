<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    protected $table = 'books';
    protected $fillable = ['title','synopsis','genre_id','author_id'];

    public function book_genres()
    {
        return $this->belongsTo(BookGenre::class,'genre_id','id');	
    }

    public function authors()
    {
        return $this->belongsTo(Author::class,'author_id','id');	
    }

    public function reviews()
    {
        return $this->hasMany(Review::class,'book_id','id');    
    }

    // Método boot para apagar as reviews junto com o livro
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($book) {
            // Apaga todas as reviews de um livro
            $book->reviews()->delete();
        });
    }
}

