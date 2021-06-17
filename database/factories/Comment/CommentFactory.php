<?php
declare(strict_types=1);

namespace Database\Factories\Comment;

use App\Models\Comment\Comment;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Class CommentFactory
 * @package Database\Factories\Comment
 */
class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws Exception
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'post_id' => random_int(1, 10),
            'content' => $this->faker->realText(),
        ];
    }
}
