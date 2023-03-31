<?php

    namespace App\Http\Controllers\Post;

    use App\Http\Controllers\Controller;
    use App\Models\Post;
    use Carbon\Carbon;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Http\Request;

    class IndexController extends Controller
    {
        /**
         * Handle the incoming request.
         */
        public function __invoke(Request $request)
        {
            return Post::with('comments', 'category')
                ->startEndDate($request)
                ->postsIds($request)
                ->isPublished($request)
                ->orderBy(
                    request('sort', 'published_date'),
                    request('order', 'desc'))
                ->paginate($request->query('limit'));
        }
    }
