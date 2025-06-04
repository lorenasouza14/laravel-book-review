<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookUser extends Model
{
    protected $table = 'book_users';
    protected $fillable = ['name','email','password'];

    public function reviews()
    {
        return $this->hasMany(Review::class,'bookuser_id','id');	
    }
}