@extends('layouts.app')

@section('content')
    <h2>Books</h2>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        @formToken
        <input type="text" name="title" placeholder="Title" value="{{ old('title') }}" required>
        <input type="text" name="isbn" placeholder="ISBN (optional)" value="{{ old('isbn') }}">

        <select name="author_id" required>
            <option value="">-- Select Author --</option>
            @foreach ($authors as $author)
                <option value="{{ $author->id }}" @selected(old('author_id') == $author->id)>{{ $author->name }}</option>
            @endforeach
        </select>

        <div style="margin: 8px 0;">
            <strong>Categories:</strong>
            @foreach ($categories as $category)
                <label style="margin-right: 10px;">
                    <input type="checkbox" name="category_ids[]" value="{{ $category->id }}"
                        @checked(in_array($category->id, old('category_ids', [])))>
                    {{ $category->name }}
                </label>
            @endforeach
        </div>

        <button type="submit">Add Book</button>
    </form>

    <table>
        <tr><th>#</th><th>Title</th><th>ISBN</th><th>Author</th><th>Categories</th></tr>
        @forelse ($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->isbn }}</td>
                <td>{{ $book->author->name }}</td>
                <td>{{ $book->categories->pluck('name')->join(', ') }}</td>
            </tr>
        @empty
            <tr><td colspan="5">No books yet.</td></tr>
        @endforelse
    </table>
@endsection