<?php
namespace App\Repositories;
use App\Models\BookUser;

class BookUserRepository
{
    public function get()
    {
        return BookUser::all(); 
    }

    public function details(int $id)
    {
        return BookUser::findOrfail($id);
    }
    public function store(array $data)
    {
        return BookUser::create($data);  
    }
    public function update(int $id, array $data)
    {
        $bookUser = $this->details($id);
        $bookUser->update($data);
        return $bookUser;

    }
    
    public function delete(int $id){
        $book_User = BookUser::findOrFail($id);
        $book_User->delete();

        return $book_User;
    }
    
        //Busca a review de um usuário
    public function findReview(int $id)
    {
        $bookuser = $this->details($id);
        $reviews = $bookuser->reviews;
        return $reviews;
    }
}