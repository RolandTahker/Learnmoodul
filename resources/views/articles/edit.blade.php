@extends('partials.layout')

@section('content')
    <div class="container mx-auto w-1/2">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                {{-- Display existing image --}}
                <div class="existing-image mb-4">
                    @if($article->image)
                        <img src="{{ asset('storage/' . $article->image) }}" alt="Existing Article Image" class="max-w-full">
                    @else
                        <p>No image available</p>
                    @endif
                </div>

                {{-- Edit form --}}
                <form action="{{ route('articles.update', ['article' => $article]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- ... (existing code) ... -->

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Spiciness Level</span>
                        </label>
                        <input name="is_spicy" type="number" min="1" max="5" value="{{ $article->is_spicy }}" placeholder="1-5" class="input input-bordered w-full @error('spiciness_level') input-error @enderror" />
                        @error('is_spicy')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Is Vegan?</span>
                        </label>
                        <input name="is_vegan" type="checkbox" @if($article->is_vegan) checked @endif class="checkbox checkbox-bordered @error('is_vegan') checkbox-error @enderror" />
                        @error('is_vegan')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Price (€)</span>
                        </label>
                        <div class="relative">
                            <span class="absolute right-0 top-0 mt-2 mr-2 text-secondary">€</span>
                            <input name="price" type="number" step="0.01" placeholder="Enter the price" class="input input-bordered w-full @error('price') input-error @enderror" />
                        </div>
                        @error('price')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>


                    <input type="submit" value="Update" class="btn btn-primary mt-3">
                </form>
            </div>
        </div>
    </div>
@endsection
