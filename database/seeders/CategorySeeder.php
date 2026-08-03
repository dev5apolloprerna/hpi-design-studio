<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Residential', 'module' => 'photo_gallery'],
            ['name' => 'Commercial', 'module' => 'photo_gallery'],
            ['name' => 'Interior Design', 'module' => 'video_gallery'],
            ['name' => 'Project Walkthrough', 'module' => 'video_gallery'],
            ['name' => 'Client Feedback', 'module' => 'testimonial'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => Str::slug($category['name']) . '-' . $category['module']],
                [
                    'name' => $category['name'],
                    'module' => $category['module'],
                    'status' => 'active',
                ]
            );
        }
    }
}
