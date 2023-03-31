<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    use App\Models\Post;

    return new class extends Migration {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('comments', function (Blueprint $table) {
                $table->id();
                $table->text('content');
                $table->foreignId('parent_id')->nullable()->references('id')->on('comments');
                $table->string('user_token');
                $table->foreignIdFor(Post::class)->constrained();
                $table->boolean('is_published')->default(1);
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('comments');
        }
    };
