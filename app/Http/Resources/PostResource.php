<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "slug" => $this->slug,
            "title" => $this->title,
            "content" => $this->content,
            "author" => [
                'uuid' => $this->user->uuid,
                'name' => $this->user->name,
            ],
            "createdAt" => $this->created_at->toIso8601String(),
        ];
    }
}