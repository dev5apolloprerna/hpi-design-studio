<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'module', 'status'];

    const MODULE_PHOTO_GALLERY = 'photo_gallery';
    const MODULE_VIDEO_GALLERY = 'video_gallery';
    const MODULE_TESTIMONIAL   = 'testimonial';

    public static function moduleLabels(): array
    {
        return [
            self::MODULE_PHOTO_GALLERY => 'Photo Gallery',
            self::MODULE_VIDEO_GALLERY => 'Video Gallery',
            self::MODULE_TESTIMONIAL   => 'Testimonial',
        ];
    }

    public function getModuleLabelAttribute(): string
    {
        return self::moduleLabels()[$this->module] ?? $this->module;
    }

    public function photoGalleries()
    {
        return $this->hasMany(PhotoGallery::class);
    }

    public function videoGalleries()
    {
        return $this->hasMany(VideoGallery::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }
}
