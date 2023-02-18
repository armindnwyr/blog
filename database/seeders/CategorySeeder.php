<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->count(5)->has(
            Post::factory()->count(5)->state(
                new Sequence(
                    [
                        'publish' => true,
                        'update_at' => now()
                    ],
                    [
                        'publish' => false,
                        'update_at' => null,
                    ]
                )
            )->has(
                Tag::factory()->count(3)
            )
        )
            ->create();
    }
}
