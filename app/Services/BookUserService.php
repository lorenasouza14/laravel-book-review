<?php
namespace App\Services;
use App\Repositories\BookUserRepository;
use App\Services\ReviewService;

class BookUserService
{
    private BookUserRepository $rookUserRepository;
    public function __construct(BookUserRepository $bookUserRepository)
    {
        $this->bookUserRepository = $bookUserRepository;
    }
    
    public function get()
    {
        $bookUser = $this->bookUserRepository->get();
        return $bookUser;
    }

    public function details(int $id)
    {
        return $this->bookUserRepository->details($id);  
    }

    public function store(array $data)  
    {
        return $this->bookUserRepository->store($data);  
    }

    public function update(int $id, array $data)
    {
        return $this->bookUserRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->bookUserRepository->delete($id);
    }

    //Retorna as reviews de um usuário
    public function findReview(int $id)
    {
        return $this->bookUserRepository->findReview($id);
    }
}