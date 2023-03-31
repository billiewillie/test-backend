<?php

    namespace App\Http\Controllers\Post;

    use App\Http\Controllers\Controller;
    use App\Models\Post;
    use Illuminate\Http\Client\Request;

    class ShowController extends Controller
    {
        /**
         * Handle the incoming request.
         */
        public function __invoke(Post $post): Post
        {
            $post->increment('show_count');
            return $post->load('likes', 'comments');
        }
    }
