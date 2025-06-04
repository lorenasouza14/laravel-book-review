<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BookUserService;
use App\Http\Requests\BookUserStoreRequest;
use App\Http\Requests\BookUserUpdateRequest;
use App\Http\Resources\BookUserResource;
use App\Http\Resources\ReviewResource;
use Illuminate\DataBase\Eloquent\ModelNotFoundException;

class BookUserController extends Controller
{
    private BookUserService $bookUserService;

    public function __construct(BookUserService $bookUserService){
        $this->bookUserService = $bookUserService;
    }

    public function get(){
        $bookuser = $this->bookUserService->get();
        
        return BookUserResource::collection($bookuser);
    }

    public function details($id)
    {
        try{
            $bookUser = $this->bookUserService->details($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'User not found'],404);
        }
        return new BookUserResource($bookUser);
    }


    public function store(BookUserStoreRequest $request) {
        $data = $request->validated(); // Vai Buscar Todos os dados na requisição
        $bookuser = $this->bookUserService->store($data);
        return new BookUserResource($bookuser);
    }


    public function update(int $id, BookUserUpdateRequest $request)
    {
        $data = $request->validated();
        try{
            $bookUser = $this->bookUserService->update($id,$data);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Usuario não encontrado'],404);
        }
        return new BookUserResource($bookUser);
    }

    public function delete($id) {
        try{    
            $bookUser = $this->bookUserService->delete($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'Usuario não encontrado'],404);
        }
        return new BookUserResource($bookUser);
    }
    
    //Lista as reviews de um usuário
    public function findReview(int $id)
    {
        try{
            $reviews = $this->bookUserService->findReview($id);
        }catch(ModelNotFoundException $e){
            return response()->json(['error'=>'review não encontrado'],404);
        }
        if ($reviews->isEmpty()){
            return response()->json(['message' => 'Nenhuma review encontrada'] ,204);
        }
        return ReviewResource::collection($reviews);
    }
}