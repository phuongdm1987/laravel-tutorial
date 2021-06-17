<?php
declare(strict_types=1);

namespace Database\Factories\Tag;

use App\Models\Tag\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Class TagFactory
 * @package Database\Factories\Tag
 */
class TagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->name;
        $slug = Str::snake($name);

        return [
            'name' => $name,
            'slug' => Str::lower($slug),
        ];
    }
}
