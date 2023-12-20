@extends('partials.layout')

@section('content')
    <div class="container mx-auto">
        {{ $articles->links() }}
        <div class="flex flex-row flex-wrap">
            @foreach($articles as $article)
                <div class="basis-1/4 mb-4">
                    <div class="card mx-3 bg-base-100 shadow-xl h-full">
                        @if($article->image)
                            <figure><img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"/></figure>
                        @endif
                        <div class="card-body">
                            <h2 class="card-title">{{ $article->title }} - {{ $article->price ? '€' . number_format($article->price, 2) : '' }}</h2>
                            <p>{{ $article->getSnippetAttribute() }}</p>
                            <div class="stat">
                                <div class="stat-desc">{{ $article->user->name }}</div>
                                <div class="stat-desc">{{ $article->created_at->diffForHumans() }}</div>
                            </div>

                            {{-- Display Dietary Options --}}
                            @if($article->is_vegan)
                                <span class="badge badge-secondary badge-outline">Vegan</span>
                            @endif

                            @if($article->is_vegetarian && !$article->is_gluten_free)
                                <span class="badge badge-secondary badge-outline">Vegetarian</span>
                            @endif

                            @if($article->is_gluten_free)
                                <span class="badge badge-secondary badge-outline">Gluten Free</span>
                            @endif

                            <div class="card-actions justify-end">
                                <button class="btn btn-primary">Buy Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
