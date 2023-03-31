<?php

    namespace Database\Seeders;

    use App\Models\Channel;
    use App\Models\Post;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Collection;

    class ChannelPostSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         */
        public function run(): void
        {
            $channelIds = Channel::pluck('id');
            $postIds = Post::pluck('id');

            $chanelPosts = $channelIds->flatMap(
                fn(int $id) => $this->channelPosts($id, $this->randomPostIds($postIds))
            );

            DB::table('channel_posts')->insert($chanelPosts->all());
        }

        private function channelPosts(int $channelId, Collection $postIds): Collection
        {
            return $postIds->map(fn(int $id) => [
                'channel_id' => $channelId,
                'post_id' => $id,
            ]);
        }

        private function randomPostIds(Collection $ids)
        {
            return $ids->random(mt_rand(1, count($ids)));
        }
    }
