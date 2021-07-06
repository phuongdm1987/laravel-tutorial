@extends('layouts.app')

@section('content')
<div class="container">
    @include('components.breadcrumb')
    <div class="row justify-content-center">
        <div class="col-md-3">
            <ul class="nav nav-pills flex-column mb-5">
                @foreach($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link {{ isset($currentCategory) && $currentCategory->id === $category->id ? 'active' : '' }}" href="{{ route('categories.show', ['category' => $category->slug]) }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>

            <div id="tags-container" class="bm-5">
                @foreach($tags as $tag)
                    <a class="btn btn-sm btn-light {{ isset($currentTag) && $currentTag->id === $tag->id ? 'active' : '' }}" href="{{ route('tags.show', ['tag' => $tag->slug]) }}">{{ $tag->name }} <span class="badge badge-primary">{{ $tag->posts_count }}</span></a>
                @endforeach
            </div>
        </div>
        <div class="col-md-9">
            <div class="mb-3">
                <h1>{{ $post->title }}</h1>
                <p>{{ $post->author->name }} | {{ $post->created_at }}</p>
                <hr>

                <blockquote class="blockquote">
                    <p class="mb-0">{{ $post->summary }}</p>
                </blockquote>

                <div>{{ $post->content }}</div>
            </div>

            <div>
                <h3>{{ __('Tags') }}</h3>
                @foreach($post->tags as $tag)
                    <a class="btn btn-sm btn-dark" href="{{ route('tags.show', ['tag' => $tag->slug]) }}">{{ $tag->name }}</a>
                @endforeach
            </div>

            <div class="mt-3">
                <h3>{{ __('Comments') }}</h3>
                <form class="mb-3" action="{{ route('comments.store') }}" method="POST">
                    <div class="form-group">
                        @csrf
                        <input type="hidden" name="postId" value="{{ $post->id }}">
                        <input type="hidden" name="parentId" value="">
                        <textarea class="form-control" name="content" rows="5" placeholder="{{ __('Input your comment') }}"></textarea>
                    </div>
                    <button type="submit" class="btn btn-block btn-outline-primary">{{ __('Submit') }}</button>
                </form>
                @if ($comments->isNotEmpty())
                <div id="comment-container">
                    @foreach($comments as $comment)
                        <div class="border rounded p-3 mb-3">
                            <div>{{ $comment->author->name }} | {{ $comment->created_at }}</div>
                            <div>{{ $comment->content }}</div>

                            @foreach($comment->children as $childComment)
                                <div class="ml-5 mt-3">
                                    <div>{{ $childComment->content }}</div>
                                    <div class="text-right">{{ $childComment->author->name }} | {{ $childComment->created_at }}</div>
                                    @if(!$loop->last)
                                        <hr>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                @endif
            </div>

            <hr>
            <h3 class="mt-5">{{ __('List Recommend') }}</h3>
            <div class="list-group">
                @foreach($randomPosts as $randomPost)
                <a href="{{ route('posts.show', ['post' => $randomPost->slug]) }}" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{ $randomPost->title }}</h5>
                        <small>{{ $post->author->name }}</small>
                    </div>
                    <p class="mb-1">{{ $randomPost->summary }}</p>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>

<style>
    #comment-container {
        max-height: 500px;
        overflow: scroll;
    }
</style>
@endsection
