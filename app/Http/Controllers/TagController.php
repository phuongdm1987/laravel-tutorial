<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category\Category;
use App\Models\Post\Post;
use App\Models\Tag\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class TagController
 * @package App\Http\Controllers
 */
class TagController extends Controller
{
    /**
     * @param Tag $tag
     * @return View
     */
    public function show(Tag $tag): View
    {
        $categories = Category::withCount('posts')->get();
        $tags = Tag::withCount('posts')->get();
        $posts = Post::whereHas('tags', function (Builder $query) use ($tag) {
            $query->where('id', $tag->id);
        })->paginate(5);

        return view('post.index')
            ->with([
                'posts' => $posts,
                'categories' => $categories,
                'tags' => $tags,
                'currentTag' => $tag,
            ]);
    }
}
