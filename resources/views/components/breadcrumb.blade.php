@php
    if (!isset($currentCategory)) {
        $currentCategory = isset($post) ? $post->category : null;
    }

    $currentTag = $currentTag ?? null;

    $activeHome = request()->routeIs('posts.index');
    $activeCategory = request()->routeIs('categories.show');
    $activeTag = request()->routeIs('tags.show');
    $activePost = request()->routeIs('posts.show');
@endphp

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item {{ $activeHome ? 'active' : '' }}">
            @if($activeHome)
                Home
            @else
                <a href="{{ route('posts.index') }}">Home</a>
            @endif
        </li>
        @if($currentCategory)
            <li class="breadcrumb-item {{ $activeCategory ? 'active' : '' }}">
                @if($activeCategory)
                    {{ $currentCategory->name }}
                @else
                    <a href="{{ route('categories.show', ['category' => $currentCategory->slug]) }}">{{ $currentCategory->name }}</a>
                @endif
            </li>
        @endif

        @if($currentTag)
            <li class="breadcrumb-item {{ $activeTag ? 'active' : '' }}">
                @if($activeTag)
                    {{ $currentTag->name }}
                @else
                    <a href="{{ route('tags.show', ['tag' => $currentTag->slug]) }}">{{ $currentTag->name }}</a>
                @endif
            </li>
        @endif

        @if(isset($post))
            <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
        @endif
    </ol>
</nav>
