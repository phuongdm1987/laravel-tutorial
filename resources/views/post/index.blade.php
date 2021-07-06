@extends('layouts.app')

@section('content')
<div class="container">
    @include('components.breadcrumb')
    <div class="row justify-content-center">
        <div class="col-md-3">
            <ul class="nav nav-pills flex-column mb-5">
                @foreach($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link {{ isset($currentCategory) && $currentCategory->id === $category->id ? 'active' : '' }}" href="{{ route('categories.show', ['category' => $category->slug]) }}">{{ $category->name }} <span class="badge badge-primary">{{ $category->posts_count }}</span></a>
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
            @forelse($posts as $post)
                <div class="mb-5">
                    <h2><a href="{{ route('posts.show', ['post' => $post->slug]) }}">{{ $post->title }}</a></h2>
                    <p>{{ $post->summary }}</p>
                    <p>{{ $post->author->name }} | {{ $post->created_at }}</p>
                    <hr>
                </div>
            @empty
                <div class="mb-5">
                    <p class="text-center">No posts</p>
                </div>
            @endforelse

                {{ $posts->onEachSide(3)->links() }}
        </div>
    </div>
</div>
@endsection
