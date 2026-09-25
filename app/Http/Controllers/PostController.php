<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Services\PostService;

class PostController extends Controller
{
    use AuthorizesRequests;

    public function __construct(private readonly PostService $postService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $post = Post::with('user')->latest()->paginate(10);

        return response()->json(
            PostResource::collection($post)->response()->getData(true)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request): JsonResponse
    {
        try {
            if (!auth()->check()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Anda harus login terlebih dahulu',
                ], 401);
            }

            $data = $request->validated();
            $data['user_id'] = auth()->id();

            $post = $this->postService->create($data);

            return response()->json([
                "status" => true,
                "message" => "Post berhasil disimpan!",
                "data" => new PostResource($post),
            ], 201);
        } catch (\Throwable $e) {
            // dd($e);
            return response()->json([
                "status" => false,
                "message" => "Post gagal disimpan!",
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post): JsonResponse
    {
        $this->authorize('update', $post);

        $data = $request->validated();
        $updated = $this->postService->update($post, $data);

        return response()->json([
            'status' => true,
            'message' => 'Post berhasil di update',
            'data' => new PostResource($updated)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): JsonResponse
    {
        $this->authorize('delete', $post);

        $this->postService->delete($post);

        return response()->json([
            'status' => true,
            'message' => 'Post berhasil dihapus!',
        ]);
    }
}