<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->sentence();

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'summary'=>$this->faker->text(300),
            'description' => $this->faker->paragraph(5,true),
            // 'url' => $this->faker->url(),
            'image' => $this->faker->imageUrl(640,480),
            // 'publish' => true,
            'user_id' =>$this->faker->numberBetween(1,5),
            // 'update_at' => now(),        
        ];
    }
}
