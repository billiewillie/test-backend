<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Relations\BelongsToMany;
    use Illuminate\Database\Eloquent\Model;

    class Channel extends Model
    {
        use HasFactory;

        protected $guarded = false;

        public function posts(): BelongsToMany
        {
            return $this->belongsToMany(Post::class);
        }
    }
