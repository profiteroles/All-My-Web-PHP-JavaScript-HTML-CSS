@extends("components.layout")

@section('content')
    @include('posts._header')
    @if($posts->count())
        <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
            <x-posts-grid :posts="$posts"/>

            {{$posts->links()}}
            @else
                <p class="text-center">No posts yet. Please check back later.</p>
            @endif
        </main>
@endsection
