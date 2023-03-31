<?php

    namespace Database\Factories;

    use App\Models\Category;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Factories\Factory;

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
            $createdAt = $this->faker->dateTimeThisYear();
            $publishedDate = $this->faker->dateTimeInInterval('-11 months', '+10 months');
            $unpublishedDate = rand(1, 3) < 2 ? $publishedDate : null;

            return [
                'title' => $this->faker->words(mt_rand(1, 2), true),
                'author_id' => User::inRandomOrder()->first(),
                'category_id' => Category::inRandomOrder()->first(),
                'is_published' => $this->faker->boolean(),
                'url' => $this->faker->url(),
                'description' => $this->faker->words(mt_rand(3, 5), true),
                'content' => $this->faker->words(mt_rand(80, 100), true),
                'preview_image' => $this->faker->imageUrl(640, 480, null, true, null, false, 'jpg'),
                'show_count' => $this->faker->randomNumber(),
                'published_date' => $publishedDate,
                'unpublished_date' => $unpublishedDate,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];
        }
    }
