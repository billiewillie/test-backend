<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    use App\Models\Category;

    return new class extends Migration {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('posts', function (Blueprint $table) {
                $table->id();
                $table->string('title')->nullable();
                $table->unsignedBigInteger('author_id');
                $table->foreignIdFor(Category::class)->constrained();
                $table->boolean('is_published')->default(1);
                $table->string('url')->nullable();
                $table->text('description')->nullable();
                $table->text('content')->nullable();
                $table->string('preview_image')->nullable();
                $table->unsignedBigInteger('show_count')->default(0);
                $table->unsignedBigInteger('like_count')->default(0);
                $table->date('published_date')->default(now());
                $table->date('unpublished_date')->nullable();
                $table->timestamps();

                $table->foreign('author_id')->references('id')->on('users');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('posts');
        }
    };
