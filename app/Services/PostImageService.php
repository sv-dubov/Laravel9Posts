<?php

namespace App\Services;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostImageService
{
    protected Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function uploadImage(Post $post, $image)
    {
        if ($image == null) {
            return;
        }

        $filename = Str::random(10) . '.' . $image->extension();
        $image->storeAs('public/uploads/posts', $filename);
        $post->image = $filename;
        $post->save();
    }

    public function removeImage($image)
    {
        if ($image != null) {
            Storage::delete('public/uploads/posts/' . $image);
        }
    }
}
