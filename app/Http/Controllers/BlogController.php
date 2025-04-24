<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        // Validate the category parameter
        $validator = Validator::make($request->all(), [
            'category' => 'nullable|exists:categories,id', // Ensure the category is valid (exists in the categories table)
        ]);

        if ($validator->fails()) {
            // If validation fails, you can handle it, for example, redirect with an error message
            return redirect()->route('blog.index')->withErrors($validator)->withInput();
        }

        // Create query for articles with optional category filter
        $query = Article::with(['category', 'tags']);
        
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $articles = $query->get();
        $categories = Category::all();

        // Return the view with articles and categories
        return view('blog.index', compact('articles', 'categories'));
    }

    public function show($id)
    {
        // Validate that the article ID is a numeric value and exists
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:articles,id', // Ensure the ID is a valid numeric and exists in the articles table
        ]);

        // If validation fails, redirect with an error message
        if ($validator->fails()) {
            return redirect()->route('blog.index')->withErrors(['id' => 'The article you are looking for does not exist.']);
        }

        // Find the article by ID
        $article = Article::with(['category', 'tags'])->findOrFail($id);

        // Return the view for individual article
        return view('blog.show', compact('article'));
    }

}
