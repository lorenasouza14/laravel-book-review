<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BookGenreResource;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\ReviewResources;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> $this->id,
            'title'=> $this->title,
            'synopsis'=> $this->synopsis,
            'genre_id'=>$this->genre_id,
            'author_id'=>$this->author_id,
            'bookgenre' => new BookGenreResource($this->whenLoaded('book_genres')),
            'author' => new AuthorResource($this->whenLoaded('authors')),
            'reviews' => ReviewResource::collection($this->whenLoaded('reviews')),
        ];
    }
}
