<?php

    namespace Database\Factories;

    use App\Models\Post;
    use Illuminate\Database\Eloquent\Factories\Factory;

    /**
     * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gallery>
     */
    class GalleryFactory extends Factory
    {
        /**
         * Define the model's default state.
         *
         * @return array<string, mixed>
         */
        public function definition(): array
        {
            $files = implode(',', [
                $this->faker->imageUrl(640, 480, null, true, null, false, 'jpg'),
                $this->faker->imageUrl(650, 470, null, true, null, false, 'jpg')
            ]);

            return [
                'files' => $files,
                'post_id' => Post::inRandomOrder()->first(),
            ];
        }
    }
