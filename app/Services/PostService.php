<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public function create(array $data): Post
    {
        return Post::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'user_id' => $data['user_id'], // di set dari controller
        ]);
    }

    public function update(Post $post, array $data): Post
    {
        $post->update($data);
        return $post->fresh();
    }

    public function delete(Post $post): void
    {
        $post->delete();
    }
}

?>