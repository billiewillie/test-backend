<?php

    namespace App\Http\Controllers\View;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\View\StoreRequest;
    use App\Models\View;
    use Illuminate\Http\Request;

    class StoreController extends Controller
    {
        public function __invoke(StoreRequest $request)
        {
            $data = $request->validated();

            $view = View::firstOrCreate([
                "post_id" => $data["post_id"],
                "user_token" => $data["user_token"],
            ]);

            $view->increment('show_count');
            $view->refresh();
        }
    }
