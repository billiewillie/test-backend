<?php

    namespace App\Http\Controllers\Post;

    use App\Models\Post;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Storage;
    use App\Http\Requests\Post\UpdateRequest;

    class UpdateController extends Controller
    {
        /**
         * Handle the incoming request.
         */
        public function __invoke(UpdateRequest $request, Post $post)
        {
            $data = $request->validated();
            if (isset($data["preview_image"])) {
                $data['preview_image'] = Storage::disk('public')->put('/images', $data['preview_image']);
            }
            $post->update($data);
        }
    }
