<?php

    namespace Database\Factories;

    use App\Models\Comment;
    use App\Models\Post;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Factories\Factory;

    /**
     * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
     */
    class CommentFactory extends Factory
    {
        /**
         * Define the model's default state.
         *
         * @return array<string, mixed>
         */
        public function definition(): array
        {
            return [
                'content' => $this->faker->words(mt_rand(3, 4), true),
                'parent_id' => null,
                'user_token' => User::inRandomOrder()->first()->user_token,
                'post_id' => Post::inRandomOrder()->first(),
                'is_published' => $this->faker->boolean()
            ];
        }
    }
