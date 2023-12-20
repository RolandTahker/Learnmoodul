<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::latest()->select(['id', 'title', 'body','created_at', 'updated_at'])->paginate();
        return view('articles.index', compact('articles'));
    }
    /**
     * Display a listing of the deleted resource.
     */
    public function deleted()
    {
        $articles = Article::onlyTrashed()->orderBy('deleted_at')->paginate();
        return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        // Get the authenticated user
        $user = auth()->user();

        // Create a new article instance with the validated data
        $article = new Article($request->validated());

        // Set the user_id for the article
        $article->user_id = $user->id;

        // Check if an image file is present in the request
        if ($request->hasFile('image')) {
            // Upload and store the image
            $file = $request->file('image')->store('images', 'public');
            $article->image = $file; // Save the relative path without Storage::url
        }

        // Set spiciness level and is_vegan
        $article->is_spicy = $request->input('is_spicy', 1); // Default to 1 if not provided
        $article->is_vegan = $request->has('is_vegan') ? 1 : 0;
        $article->is_vegetarian = $request->has('is_vegetarian') ? 1 : 0;
        $article->is_gluten_free = $request->has('is_gluten_free') ? 1 : 0;
        $article->price = $request->input('price');


        // Save the article
        $article->save();

        return redirect()->route('articles.index');
    }



    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return view('articles.show', compact('article'));


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        // Update article fields
        $article->fill($request->validated());

        // Set spiciness level and is_vegan
        $article->is_spicy = $request->input('is_spicy', 1); // Default to 1 if not provided
        $article->is_vegan = $request->has('is_vegan') ? 1 : 0;
        $article->is_vegetarian = $request->has('is_vegetarian') ? 1 : 0;
        $article->is_gluten_free = $request->has('is_gluten_free') ? 1 : 0;
        $article->price = $request->input('price');


        $article->save();

        // Check if a new image is provided
        if ($request->hasFile('image')) {
            // Delete the old image (if exists)
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }

            // Store the new image
            $file = $request->file('image')->store('images', 'public');
            $article->image = $file; // Save the relative path without Storage::url
            $article->save(); // Save the updated article with the new image
        }

        return redirect()->route('articles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index');
    }
}
