<?php

    namespace Database\Factories;

    use App\Models\Post;
    use App\Models\User;
    use Illuminate\Database\Eloquent\Factories\Factory;

    /**
     * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\View>
     */
    class ViewFactory extends Factory
    {
        /**
         * Define the model's default state.
         *
         * @return array<string, mixed>
         */
        public function definition(): array
        {
            return [
                'post_id' => Post::inRandomOrder()->first(),
                'user_token' => User::inRandomOrder()->first()->user_token,
                'show_count' => $this->faker->randomNumber()
            ];
        }
    }
