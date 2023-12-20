@extends('partials.layout')

@section('content')
    <div class="container mx-auto w-1/2">
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Title</span>
                        </label>
                        <input name="title" type="text" placeholder="Article Title" class="input input-bordered w-full @error('title') input-error @enderror" />
                        @error('title')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Content</span>
                        </label>
                        <textarea name="body" class="textarea textarea-bordered @error('body') textarea-error @enderror" placeholder="Content here"></textarea>
                        @error('body')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Image</span>
                        </label>
                        <input name="image" type="file" class="file-input input-bordered w-full @error('image') input-error @enderror"/>
                        @error('image')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Spiciness Level</span>
                        </label>
                        <input name="is_spicy" type="number" min="1" max="5" placeholder="1-5" class="input input-bordered w-full @error('spiciness_level') input-error @enderror" />
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
                        <input name="is_vegan" type="checkbox" class="checkbox checkbox-bordered @error('is_vegan') checkbox-error @enderror" />
                        @error('is_vegan')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Is Vegetarian?</span>
                        </label>
                        <input name="is_vegetarian" type="checkbox" class="checkbox checkbox-bordered @error('is_vegetarian') checkbox-error @enderror" />
                        @error('is_vegetarian')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Is Gluten Free?</span>
                        </label>
                        <input name="is_gluten_free" type="checkbox" class="checkbox checkbox-bordered @error('is_gluten_free') checkbox-error @enderror" />
                        @error('is_gluten_free')
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



                    <input type="submit" value="Create" class="btn btn-primary mt-3">
                </form>
            </div>
        </div>
    </div>
@endsection
