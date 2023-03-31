<?php

    namespace Tests\Feature\Api;

    use App\Models\Category;
    use App\Models\Post;
    use App\Models\Role;
    use App\Models\User;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Illuminate\Http\Testing\File;
    use Illuminate\Support\Facades\Storage;
    use Tests\TestCase;

    class PostTest extends TestCase
    {
        use RefreshDatabase;

        protected function setUp(): void
        {
            parent::setUp();
            Storage::fake('public');
            $this->withHeaders([
                'accept' => 'application/json'
            ]);
        }

        /** @test */
        public function post_can_be_stored(): void
        {
            $this->withoutExceptionHandling();

            $role = Role::factory()->create();
            $authorId = User::factory()->create(["role_id" => $role->id])->id;
            $categoryId = Category::factory()->create(["id" => 1])->id;

//            Storage::fake('public');

            $image = File::create('image.jpg');

            $data = [
                "title" => "title 4",
                'author_id' => $authorId,
                'category_id' => $categoryId,
                "is_published" => 0,
                'url' => "https://hello.ru",
                'description' => "test test new test",
                'content' => "test test test",
                'preview_image' => $image,
                'published_date' => "2023-01-02",
                'unpublished_date' => "2023-03-12"
            ];

            $response = $this->post('/api/posts', $data);

            $this->assertDatabaseCount('posts', 1);

            $post = Post::first();

            $this->assertEquals($data["title"], $post->title);
            $this->assertEquals($data["author_id"], $post->author_id);
            $this->assertEquals($data["category_id"], $post->category_id);
            $this->assertEquals($data["is_published"], $post->is_published);
            $this->assertEquals($data["url"], $post->url);
            $this->assertEquals($data["description"], $post->description);
            $this->assertEquals($data["content"], $post->content);
            $this->assertEquals("images/" . $image->hashName(), $post->preview_image);
            $this->assertEquals($data["published_date"], $post->published_date);
            $this->assertEquals($data["unpublished_date"], $post->unpublished_date);

            Storage::disk('public')->assertExists($post->preview_image);
        }

        /** @test */
        public function attribute_title_is_required_for_storing_post(): void
        {
            $role = Role::factory()->create();
            $authorId = User::factory()->create(["role_id" => $role->id])->id;
            $categoryId = Category::factory()->create(["id" => 1])->id;

            Storage::fake('public');

            $image = File::create('image.jpg');

            $data = [
                "title" => "",
                'author_id' => $authorId,
                'category_id' => $categoryId,
                "is_published" => 0,
                'url' => "https://hello.ru",
                'description' => "test test new test",
                'content' => "test test test",
                'preview_image' => $image,
                'published_date' => "2023-01-02",
                'unpublished_date' => "2023-03-12"
            ];

            $response = $this->post('/api/posts', $data);

            $response->assertStatus(422);
            $response->assertInvalid('title');
        }

        /** @test */
        public function attribute_author_id_is_required_for_storing_post(): void
        {
            $role = Role::factory()->create();
            $categoryId = Category::factory()->create(["id" => 1])->id;

            Storage::fake('public');

            $image = File::create('image.jpg');

            $data = [
                "title" => "title",
                'author_id' => null,
                'category_id' => $categoryId,
                "is_published" => 0,
                'url' => "https://hello.ru",
                'description' => "test test new test",
                'content' => "test test test",
                'preview_image' => $image,
                'published_date' => "2023-01-02",
                'unpublished_date' => "2023-03-12"
            ];

            $response = $this->post('/api/posts', $data);

            $response->assertStatus(422);
            $response->assertInvalid('author_id');
        }

        /** @test */
        public function attribute_category_id_is_required_for_storing_post(): void
        {
            $role = Role::factory()->create();
            $authorId = User::factory()->create(["role_id" => $role->id])->id;

            Storage::fake('public');

            $image = File::create('image.jpg');

            $data = [
                "title" => "title",
                'author_id' => $authorId,
                'category_id' => null,
                "is_published" => 0,
                'url' => "https://hello.ru",
                'description' => "test test new test",
                'content' => "test test test",
                'preview_image' => $image,
                'published_date' => "2023-01-02",
                'unpublished_date' => "2023-03-12"
            ];

            $response = $this->post('/api/posts', $data);

            $response->assertStatus(422);
            $response->assertInvalid('category_id');
        }

        /** @test */
        public function attribute_preview_image_is_file_for_storing_post(): void
        {
            $role = Role::factory()->create();
            $authorId = User::factory()->create(["role_id" => $role->id])->id;
            $categoryId = Category::factory()->create(["id" => 1])->id;

            $data = [
                "title" => "title",
                'author_id' => $authorId,
                'category_id' => $categoryId,
                "is_published" => 0,
                'url' => "https://hello.ru",
                'description' => "test test new test",
                'content' => "test test test",
                'preview_image' => 1,
                'published_date' => "2023-01-02",
                'unpublished_date' => "2023-03-12"
            ];

            $response = $this->post('/api/posts', $data);

            $response->assertStatus(422);
            $response->assertInvalid('preview_image');
        }
    }
