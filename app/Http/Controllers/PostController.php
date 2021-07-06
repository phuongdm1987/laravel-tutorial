<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category\Category;
use App\Models\Post\Post;
use App\Models\Tag\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

/**
 * Class PostController
 * @package App\Http\Controllers
 */
class PostController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {
        $categories = Category::withCount('posts')->get();
        $tags = Tag::withCount('posts')->get();
        $posts = Post::paginate(5);

        return view('post.index')
            ->with([
                'posts' => $posts,
                'categories' => $categories,
                'tags' => $tags,
            ]);
    }

    /**
     * @param Post $post
     * @return View
     */
    public function show(Post $post): View
    {
        $categories = Category::withCount('posts')->get();
        $tags = Tag::withCount('posts')->get();
        $randomPosts = Post::inRandomOrder()->where('id', '!=', $post->id)->take(3)->get();
        $comments = $post->comments()
            ->where('parent_id', 'in', 0)
            ->orderByDesc('id')
            ->get();

        return view('post.show')
            ->with([
                'post' => $post,
                'comments' => $comments,
                'categories' => $categories,
                'tags' => $tags,
                'randomPosts' => $randomPosts,
            ]);
    }
}
