<?php

    namespace App\Models;

    use Carbon\Carbon;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\BelongsToMany;
    use Illuminate\Database\Eloquent\Relations\HasMany;

    class Post extends Model
    {
        use HasFactory;

        protected $guarded = false;

        public function galleries(): HasMany
        {
            return $this->hasMany(Gallery::class);
        }

        public function likes(): HasMany
        {
            return $this->hasMany(Like::class);
        }

        public function views(): HasMany
        {
            return $this->hasMany(View::class);
        }

        public function comments(): HasMany
        {
            return $this->hasMany(Comment::class);
        }

        public function category(): BelongsTo
        {
            return $this->belongsTo(Category::class);
        }

        public function channels(): BelongsToMany
        {
            return $this->belongsToMany(Channel::class);
        }

        public function scopeStartEndDate($query, $request)
        {
            if ($request->query('start_date')) {
                $startDate = Carbon::createFromFormat('Y-m-d', $request->query('start_date'))->startOfDay();

                if ($request->query('end_date')) {
                    $endDate = Carbon::createFromFormat('Y-m-d', $request->query('end_date'))->endOfDay();
                    return $query->whereBetween('published_date', [$startDate, $endDate]);
                }

                return $query->whereBetween('published_date', [$startDate, now()]);
            }

            return $query;
        }

        public function scopeIsPublished($query)
        {
            return $query->where("is_published", 1)
                ->where("published_date", "<", now())
                ->where("unpublished_date", null);
        }

        public function scopePostsIds($query, $request)
        {
            // получить несколько постов
            // ?id=1&id=2
            if ($request->query('post')) {
                return $query->whereIn('id', $request->query('post'));
            }

            return $query;
        }
    }
