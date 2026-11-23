<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['author', 'categories'])->latest()->get();
        $authors = Author::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        return view('books.index', compact('books', 'authors', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:50',
            'author_id' => 'required|exists:authors,id',
            'category_ids' => 'nullable|array',
            'category_ids.*' => 'exists:categories,id',
        ]);

        $book = Book::create([
            'title' => $data['title'],
            'isbn' => $data['isbn'] ?? null,
            'author_id' => $data['author_id'],
        ]);

        $book->categories()->sync($data['category_ids'] ?? []);

        return redirect()->route('books.index')->with('success', 'Book added.');
    }
}