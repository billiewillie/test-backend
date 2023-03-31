<?php

    namespace App\Http\Controllers\Category;

    use App\Http\Controllers\Controller;
    use App\Models\Category;
    use Illuminate\Database\Eloquent\Collection;

    class IndexController extends Controller
    {
        public function __invoke(): Collection
        {
            return Category::with('posts')->get();
        }
    }
