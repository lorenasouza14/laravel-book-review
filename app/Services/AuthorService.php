<?php
namespace App\Services;
use App\Repositories\AuthorRepository;
use App\Services\BookService;


class AuthorService
{
    private AuthorRepository $authorRepository;
    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }
    
    public function get()
    {
        $authors = $this->authorRepository->get();
        return $authors;
    }

    public function details(int $id)
    {
        return $this->authorRepository->details($id);  
    }

    public function store(array $data)  
    {
        return $this->authorRepository->store($data);  
    }

    public function update(int $id, array $data)
    {
        return $this->authorRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this ->authorRepository->delete($id);
    }

    public function getWithBook()
    {
        return $this ->authorRepository->getwithBook();
    }

    public function findBook(int $id)
    {
        return $this ->authorRepository->findBook($id);
    }
}