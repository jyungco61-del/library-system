@extends('layouts.app')

@section('content')
    <h2>Categories</h2>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        @formToken
        <input type="text" name="name" placeholder="Category name" value="{{ old('name') }}" required>
        <button type="submit">Add Category</button>
    </form>

    <table>
        <tr><th>#</th><th>Name</th><th>Number of Books</th></tr>
        @forelse ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->books_count }}</td>
            </tr>
        @empty
            <tr><td colspan="3">No categories yet.</td></tr>
        @endforelse
    </table>
@endsection