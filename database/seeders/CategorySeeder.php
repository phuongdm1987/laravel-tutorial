<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Category\Category;
use App\Models\Comment\Comment;
use App\Models\Post\Post;
use App\Models\Tag\Tag;
use Illuminate\Database\Seeder;

/**
 * Class CategorySeeder
 * @package Database\Seeders
 */
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'News General',
                'slug' => 'news-general',
            ],
            [
                'name' => 'Technology - Hi Tech',
                'slug' => 'technology-hi-tech',
            ],
            [
                'name' => 'Health',
                'slug' => 'health',
            ],
            [
                'name' => 'Fashion',
                'slug' => 'fashion',
            ],
            [
                'name' => 'Sport',
                'slug' => 'sport',
            ],
            [
                'name' => 'Culture & Education',
                'slug' => 'culture-&-education',
            ],
            [
                'name' => 'Automotive & Vehicles',
                'slug' => 'automotive-&-vehicles',
            ],
        ];

        $categories = Category::factory()->createMany($data);

        $tags = Tag::factory()->count(10)->create();

        $posts = collect();
        for ($i = 1; $i <= 10; $i++) {
            $post = Post::factory()->create([
                'category_id' => $categories->random()->id,
            ]);

            $posts->add($post);
        }

        foreach ($posts as $post) {
            $post->tags()->sync([
                'tag_id' => $tags->random()->id,
            ]);
        }

        $comments = collect();
        for ($i = 1; $i <= 10; $i++) {
            $comment = Comment::factory()->create([
                'post_id' => $posts->random()->id,
            ]);

            $comments->add($comment);
        }

        foreach ($comments as $comment) {
            Comment::factory([
                'parent_id' => $comment->id,
                'post_id' => $comment->post_id,
            ])
                ->count(2)
                ->create();
        }
    }
}
