<?php

    namespace App\Http\Controllers\Like;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Like\StoreRequest;
    use App\Models\Like;
    use App\Models\Post;

    class StoreController extends Controller
    {
        public function __invoke(StoreRequest $request)
        {
            $data = $request->validated();

            $post = Post::find($data["post_id"]);

            $data["is_liked"] === 1 ? $post->increment('like_count') : $post->decrement('like_count');

            Like::updateOrCreate(
                [
                    "post_id" => $data["post_id"],
                    "user_token" => $data["user_token"],
                ],
                [
                    "post_id" => $data["post_id"],
                    "user_token" => $data["user_token"],
                    "is_liked" => $data["is_liked"]
                ]);
        }
    }
