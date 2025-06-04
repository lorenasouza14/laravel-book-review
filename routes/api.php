<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookUserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookGenreController;


//ROTAS PARA OS AUTORES
Route::controller(AuthorController::class)->group(function (){
    Route::get('/authors', 'get');
    Route::get('/authors/books', 'getWithBook');
    Route::get('/authors/{id}', 'details');
    Route::post('/authors', 'store');
    Route::patch('/authors/{id}', 'update');
    Route::delete('/authors/{id}','delete');
    Route::get('/authors/books/{id}', 'findBook');

});

//ROTAS DOS LIVROS
Route::controller(BookController::class)->group(function (){
    Route::get('/books','get');
    Route::get('/books/genre','getWithGenre');
    Route::get('/books/authors','getWithAuthors');
    Route::get('/books/{id}', 'details');
    Route::post('/books', 'store');
    Route::patch('/books/{id}', 'update');
    Route::delete('/books/{id}','delete');
    Route::get('/books/genre/{id}','findGenre');
    Route::get('/books/authors/{id}','findAuthor');
    Route::get('/books/reviews/{id}','findReview');
    //Listar Todos os Livros com o genero autor e reviwes
    Route::get('/books/genre/authors/reviews','getWithGenreAuthorsReviews');
});

//ROTAS PARA O GENERO
Route::controller(BookGenreController::class)->group(function () {
    Route::get('/genres', 'get');
    Route::get('/genres/books', 'getWithBook');
    Route::get('/genres/{id}', 'details');
    Route::post('/genres', 'store');
    Route::patch('/genres/{id}', 'update');
    Route::delete('/genres/{id}', 'delete');
    Route::get('/genres/books/{id}', 'findBook');
});

//ROTAS DAS REVIEWS
Route::controller(ReviewController::class)->group(function (){
    Route::get('/reviews', 'get');
    Route::get('/reviews/{id}', 'details');
    Route::post('/reviews', 'store');
    Route::patch('/reviews/{id}', 'update');
    Route::delete('/reviews/{id}','delete');
});

//ROTAS DOS USUÁRIOS
Route::controller(BookUserController::class)->group(function (){
    Route::get('/users', 'get');
    Route::get('/users/{id}', 'details');
    Route::post('/users', 'store');
    Route::patch('/users/{id}', 'update');
    Route::delete('/users/{id}','delete');
    Route::get('/users/reviews/{id}', 'findReview');
});
