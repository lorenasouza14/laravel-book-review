<?php
namespace App\Repositories;
use App\Models\BookGenre;

class BookGenreRepository
{
    public function get()
    {
        return BookGenre::all(); 
    }

    public function details(int $id)
    {
        return BookGenre::findOrfail($id);
    }
    public function store(array $data)
    {
        return BookGenre::create($data);  
    }
    public function update(int $id, array $data)
    {
        $bookGenre = $this->details($id);
        $bookGenre->update($data);
        return $bookGenre;

    }
    public function delete(int $id)
    {
        $bookGenre = $this->details($id);
        $bookGenre->delete();
        return $bookGenre;
    }

    // Busca todos os livros com generos
    public function getWithBook() {
        $bookGenres = BookGenre::with('books')->get();
        return $bookGenres;
    }

    // Busca os detalhes de um único gênero de livro com base no ID fornecido.
    public function findBook(int $id)
    {
        $bookGenre = $this->details($id);
        $books = $bookGenre->books;
        return $books; 
    }
}