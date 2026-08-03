<?php

namespace Tests\Feature;

use App\Models\PhotoGallery;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadHelperTest extends TestCase
{
    public function test_it_adds_and_deletes_an_image_on_the_uploads_disk(): void
    {
        Storage::fake('uploads');

        $path = upload_file(
            UploadedFile::fake()->createWithContent('photo.jpg', 'image contents'),
            'photo-gallery'
        );

        $this->assertStringStartsWith('photo-gallery/', $path);
        Storage::disk('uploads')->assertExists($path);

        $this->assertTrue(delete_uploaded_file($path));
        Storage::disk('uploads')->assertMissing($path);
    }

    public function test_photo_image_url_uses_the_uploads_disk_url(): void
    {
        config([
            'filesystems.disks.uploads.root' => public_path(),
            'filesystems.disks.uploads.url' => 'https://example.com/hpi-design-studio',
        ]);

        $photo = new PhotoGallery(['image' => 'photo-gallery/example.jpg']);

        $this->assertSame(
            'https://example.com/hpi-design-studio/photo-gallery/example.jpg',
            $photo->image_url
        );
    }
}
