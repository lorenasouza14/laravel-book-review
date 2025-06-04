<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BookGenreService;
use App\Http\Requests\BookGenreStoreRequest;
use App\Http\Requests\BookGenreUpdateRequest;
use App\Http\Resources\BookGenreResource;
use App\Http\Resources\BookResource;
use Illuminate\DataBase\Eloquent\ModelNotFoundException;

class BookGenreController extends Controller
{
    private BookGenreService $bookGenreService;

    public function __construct(BookGenreService $bookGenreService){
        $this->bookGenreService = $bookGenreService;
    }

    public function get(){
        $bookGenres = $this->bookGenreService->get();
        return BookGenreResource::collection($bookGenres);
    }
    
    public function details($id)
    {
        try{
            $bookGenre = $this->bookGenreService->details($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Gênero literário não encontrado'],404);
        }
        return new BookGenreResource($bookGenre);
    }

    public function store(BookGenreStoreRequest $request) {
        $data = $request->validated(); 
        $bookGenre = $this->bookGenreService->store($data);
        return new BookGenreResource($bookGenre);
    }

    public function update(int $id, BookGenreUpdateRequest $request)
    {
        $data = $request->validated();
        try{
            $bookGenre = $this->bookGenreService->update($id,$data);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'ênero literário não encontrado'],404);
        }
        return new BookGenreResource($bookGenre);
    }

    public function delete($id) {
        try{
        $bookGenre = $this->bookGenreService->delete($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Gênero literário não encontrado'],404);
        }
        return new BookGenreResource($bookGenre);
    }

    //Lista os livros associados ao genero
    public function getWithBook() {
        $bookGenres = $this->bookGenreService->getWithBook();
        return BookGenreResource::collection($bookGenres);
    }

    //Busca os livros de tal genero
public function findBook(int $id)
    {
        try{
            $book = $this->bookGenreService->findBook($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Gênero literário não encontrado'],404);
        }
        return  BookResource::collection($book);
    }
}

