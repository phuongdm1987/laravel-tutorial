<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category\Category;
use App\Models\Post\Post;
use App\Models\Tag\Tag;
use Illuminate\Contracts\View\View;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    /**
     * @param Category $category
     * @return View
     */
    public function show(Category $category): View
    {
        $categories = Category::withCount('posts')->get();
        $tags = Tag::withCount('posts')->get();
        $posts = Post::where('category_id', $category->id)->paginate(5);

        return view('post.index')
            ->with([
                'posts' => $posts,
                'categories' => $categories,
                'tags' => $tags,
                'currentCategory' => $category,
            ]);
    }
}
