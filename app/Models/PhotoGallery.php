<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoGallery extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'image', 'description', 'status'];

    protected static function booted(): void
    {
        // Whenever a photo gallery record is deleted, remove its uploaded
        // image file from storage as well, using the upload helper.
        static::deleting(function (PhotoGallery $photo) {
            delete_uploaded_file($photo->image);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
