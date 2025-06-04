<?php
namespace App\Services;
use App\Repositories\BookRepository;


class BookService
{
    private BookRepository $bookRepository;
    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }
    
    public function get()
    {
        $books = $this->bookRepository->get();
        return $books;
    }

    public function details(int $id)
    {
        return $this->bookRepository->details($id);  
    }

    public function store(array $data)  
    {
        return $this->bookRepository->store($data);  
    }

    public function update(int $id, array $data)
    {
        return $this->bookRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->bookRepository->delete($id);
    }


    // Retorna todos os livros com seus respectivos gêneros.
    public function getWithGenre()
    {
        return $this->bookRepository->getwithGenre();
    }

    // Retorna os gêneros de um livro específico pelo ID.
    public function findGenre(int $id)
    {
        return $this->bookRepository->findGenre($id);
    }

    // Retorna todos os livros com seus autores associados.
    public function getWithAuthors()
    {
        return $this->bookRepository->getwithAuthors();
    }

    // Retorna os autores de um livro específico pelo ID.
    public function findAuthor(int $id)
    {
        return $this->bookRepository->findAuthor($id);
    }

    // Retorna as avaliações (reviews) de um livro específico pelo ID.
    public function findReview(int $id)
    {
        return $this->bookRepository->findReview($id);
    }

    // Retorna todos os livros com gêneros, autores e avaliações carregados juntos.
    public function getWithGenreAuthorsReviews()
    {
        return $this->bookRepository->getWithGenreAuthorsReviews();
    }

}