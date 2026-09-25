<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Str;

class Post extends Model
{
    protected $fillable = ['slug', 'title', 'content', 'user_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $baseSlug = Str::slug($post->title);
            $slug = $baseSlug;
            $counter = 1;

            while (static::where('slug', $slug)->exists()) {
                $slug = "{$baseSlug}-{$counter}";
                $counter++;
            }

            $post->slug = $slug;
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}