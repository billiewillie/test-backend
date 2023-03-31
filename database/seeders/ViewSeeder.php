<?php

    namespace Database\Seeders;

    use App\Models\View;
    use Illuminate\Database\Seeder;

    class ViewSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            View::factory(10)->create();
        }
    }
