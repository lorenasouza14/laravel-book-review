<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\BookService;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookGenreResource;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\ReviewResource;
use Illuminate\DataBase\Eloquent\ModelNotFoundException;

class BookController extends Controller
{
    private BookService $bookService;

    public function __construct(BookService $bookService){
        $this->bookService = $bookService;
    }

    public function get(){
        $book = $this->bookService->get();
        return BookResource::collection($book);
    }

    public function details($id)
    {
        try{
            $book = $this->bookService->details($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Book not found'],404);
        }
        return new BookResource($book);
    }


    public function store(BookStoreRequest $request) {
        $data = $request->validated(); // Vai Buscar Todos os dados na requisição
        $book = $this->bookService->store($data);
        return new BookResource($book);
    }

public function update(int $id, BookUpdateRequest $request)
    {
        $data = $request->validated();
        try{
            $book = $this->bookService->update($id,$data);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Livro não encontrado'],404);
        }
        return new BookResource($book);

    }

    public function delete($id) {
        try{    
        $book = $this->bookService->delete($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Livro não encontrado'],404);
        }
        return new BookResource($book);
    }

    public function getWithGenre() {
        $books = $this->bookService->getWithGenre();
        return BookResource::collection($books);
    }

public function findGenre(int $id)
    {
        try{
            $genre = $this->bookService->findGenre($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Livro não encontrado'],404);
        }
        return new BookGenreResource($genre);
    }

    //Lista os livros com os autores
public function getWithAuthors() {
        $books = $this->bookService->getWithAuthors();
        return BookResource::collection($books);
    }

    //Busca o autor de um livro
public function findAuthor(int $id)
    {
        try{
            $author = $this->bookService->findAuthor($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Livro não encontrado'],404);
        }
        return new AuthorResource($author);
    }

    //Busca as review de um livro
    public function findReview(int $id)
    {
        try{
            $reviews = $this->bookService->findReview($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'review não encontrado'],404);
        }
        if ($reviews->isEmpty()){
            return response()->json(['message' => 'Nenhuma review encontrada'] ,204);
        }
        return ReviewResource::collection($reviews);
    }

    //Lista o genero, autor e reviews de um livro
    public function getWithGenreAuthorsReviews()
    {
        $books = $this->bookService->getWithGenreAuthorsReviews();
        return BookResource::collection($books);
    }

}
