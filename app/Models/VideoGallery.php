<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoGallery extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'video_url', 'description', 'status'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Try to build a thumbnail/embeddable URL for common providers (YouTube/Vimeo).
     */
    public function getEmbedUrlAttribute(): string
    {
        $url = $this->video_url;

        if (preg_match('/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|embed\/))([A-Za-z0-9_-]+)/', $url, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }

        if (preg_match('/vimeo\.com\/(\d+)/', $url, $m)) {
            return 'https://player.vimeo.com/video/' . $m[1];
        }

        return $url;
    }
}
