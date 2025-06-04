<?php
namespace App\Repositories;
use App\Models\Author;

class AuthorRepository
{
    public function get()
    {
        return Author::all(); 
    }

    public function details(int $id)
    {
        return Author::findOrfail($id);
    }
    public function store(array $data)
    {
        return Author::create($data);  
    }
    public function update(int $id, array $data)
    {
        $author = $this->details($id);
        $author->update($data);
        return $author;

    }
    public function delete(int $id)
    {
        $author = $this ->details($id);
        $author->delete();
        return $author;
    }

     // Recupera todos os autores do banco de dados, já carregando o relacionamento com os livros.
    public function getWithBook() {
        $author = Author::with('books')->get();
        return $author;
    }

     // Recupera os detalhes de um autor específico pelo id
    public function findBook(int $id) {
        $author = $this->details($id);
        $books = $author->books;
        return $books; 
    }
}
