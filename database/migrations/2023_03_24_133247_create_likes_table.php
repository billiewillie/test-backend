<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    use  App\Models\Post;

    return new class extends Migration {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('likes', function (Blueprint $table) {
                $table->id();
                $table->foreignIdFor(Post::class)->constrained();
                $table->string('user_token');
                $table->boolean('is_liked')->default(1);
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('likes');
        }
    };
