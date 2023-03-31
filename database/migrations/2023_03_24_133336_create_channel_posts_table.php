<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    use App\Models\Channel;
    use App\Models\Post;

    return new class extends Migration {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('channel_posts', function (Blueprint $table) {
                $table->id();
                $table->foreignIdFor(Channel::class)->constrained();
                $table->foreignIdFor(Post::class)->constrained();
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('channel_posts');
        }
    };
