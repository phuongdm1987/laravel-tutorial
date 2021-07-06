<?php
declare(strict_types=1);

namespace Database\Factories\Post;

use App\Models\Post\Post;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * Class PostFactory
 * @package Database\Factories\Post
 */
class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws Exception
     */
    public function definition(): array
    {
        $title = $this->faker->unique()->name;
        $slug = Str::snake($title);
        $status = Arr::random([
            'DRAFT',
            'PUBLISHED',
        ]);

        return [
            'author_id' => 1,
            'category_id' => random_int(1, 7), // 7 category in CategorySeeder
            'title' => $title,
            'slug' => Str::lower($slug),
            'summary' => $this->faker->paragraph,
            'content' => $this->faker->realText(2000),
            'status' => $status,
        ];
    }
}
