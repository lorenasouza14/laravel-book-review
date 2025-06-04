<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthorService;
use App\Http\Requests\AuthorStoreRequest;
use App\Http\Requests\AuthorUpdateRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\AuthorResource;
use Illuminate\DataBase\Eloquent\ModelNotFoundException;

class AuthorController extends Controller
{
    private AuthorService $authorService;

    public function __construct(AuthorService $authorService){
        $this->authorService = $authorService;
    }

    public function get(){
        $authors = $this->authorService->get();
        return AuthorResource::collection($authors);
    }

    public function details($id)
    {
        try{
            $author = $this->authorService->details($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Autor not found'],404);
        }
        return new AuthorResource($author);
    }

    public function store(AuthorStoreRequest $request) {
        $data = $request->validated(); 
        $author = $this->authorService->store($data);
        return new AuthorResource($author);
    }

    public function update(int $id, AuthorUpdateRequest $request)
    {
        $data = $request->validated();
        try{
            $author = $this->authorService->update($id,$data);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Autor não encontrado'],404);
        }
        return new AuthorResource($author);
    }

    public function delete($id) {
        try{    
        $authors = $this->authorService->delete($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Autor não encontrado'],404);
        }
        return new AuthorResource($authors);
    }

    //Lista todos os autores com os livros
    public function getWithBook() {
        $authors = $this->authorService->getWithBook();
        return AuthorResource::collection($authors);
    }

    //Busca um livro de um autor
    public function findBook(int $id)
    {
        try{
            $books = $this->authorService->findBook($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Autor não encontrado'],404);
        }
        return BookResource::collection($books);
    }
}

