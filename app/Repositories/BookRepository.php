<?php
namespace App\Repositories;
use App\Models\Book;

class BookRepository
{
    public function get()
    {
        return Book::all(); 
    }

    public function details(int $id)
    {
        return Book::findOrfail($id);
    }
    public function store(array $data)
    {
        return Book::create($data);  
    }
    public function update(int $id, array $data)
    {
        $book = $this->details($id);
        $book->update($data);
        return $book;

    }
    public function delete(int $id)
    {
        $book = $this ->details($id);
        $book->delete();
        return $book;
    }

    // Busca todos os livros com os generos
    public function getWithGenre() {
        $books = Book::with('book_genres')->get();
        return $books;
    }

    //Busca os generos de um livro
    public function findGenre(int $id)
    {
        $book = $this->details($id);
        $genres = $book ->book_genres;
        return $genres; 
    }

    //Lista os autores dos livros
    public function getWithAuthors() 
    {
        $books = Book::with('authors')->get();
        return $books;
    }

    //Busca o autor de um livro
    public function findAuthor(int $id)
    {
        $book = $this->details($id);
        $author = $book ->authors;
        return $author; 
    }

    //Busca as reviews de um livro
    public function findReview(int $id)
    {
        $book = $this->details($id);
        $reviews = $book->reviews;
        return $reviews;
    }

    //Retorna os livros com o genero, autor, e reviews
    public function getWithGenreAuthorsReviews()
    {
        return Book::with(['book_genres', 'authors', 'reviews'])->get();
    }


}
