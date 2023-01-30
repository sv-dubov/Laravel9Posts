<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'category_id', 'image', 'user_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImage()
    {
        if ($this->image == null) {
            return '/img/no-image.png';
        }
        return Storage::url('uploads/posts/' . $this->image);
    }
}
