<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "rating"=> $this->rating,
            "comment"=> $this->comment,
            'book_id'=>$this->book_id,
            'bookuser' => $this->book_user,
            'bookuser'=> new BookUserResource($this->whenloaded('book_user')),
            'book' => new BookResource($this->whenLoaded('book')),
        ];
    }
}
