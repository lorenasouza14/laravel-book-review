<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model

{
    protected $table = 'reviews';
    protected $fillable = ['rating','comment','bookuser_id','book_id'];

    public function book_user()
    {
        return $this->belongsTo(BookUser::class,'bookuser_id','id');	
    }

    public function book()
    {
        return $this->belongsTo(Book::class,'book_id','id');	
    }
}