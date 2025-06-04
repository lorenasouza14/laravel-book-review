<?php
namespace App\Services;
use App\Repositories\BookGenreRepository;
use App\Models\BookGenre;

class BookGenreService
{
    private BookGenreRepository $bookGenreRepository;
    public function __construct(BookGenreRepository $bookGenreRepository)
    {
        $this->bookGenreRepository = $bookGenreRepository;
    }
    
    public function get()
    {
        $bookGenres = $this->bookGenreRepository->get();
        return $bookGenres;
    }

    public function details(int $id)
    {
        return $this->bookGenreRepository->details($id);
    }

    public function store(array $data)
    {
        return $this->bookGenreRepository->store($data);
    }

    public function update(int $id, array $data)
    {
        return $this->bookGenreRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        $bookGenre = BookGenre::findOrfail($id);
        $bookGenre->delete();
        return $bookGenre;
    }

     // retorna todos os gêneros de livros com os livros relacionados.
    public function getWithBook()
    {
        return $this->bookGenreRepository->getWithBook();
    }

    //retorna o genero de um livro
    public function findBook(int $id)
    {
        return $this->bookGenreRepository->findBook($id);
    }
}
