<?php
declare(strict_types=1);

namespace Database\Factories\Category;

use App\Models\Category\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * Class CategoryFactory
 * @package Database\Factories\Category
 */
class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

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
