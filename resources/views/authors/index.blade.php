@extends('layouts.app')

@section('content')
    <h2>Authors</h2>

    <form action="{{ route('authors.store') }}" method="POST">
        @csrf
        @formToken
        <input type="text" name="name" placeholder="Author name" value="{{ old('name') }}" required>
        <button type="submit">Add Author</button>
    </form>

    <table>
        <tr><th>#</th><th>Name</th><th>Number of Books</th></tr>
        @forelse ($authors as $author)
            <tr>
                <td>{{ $author->id }}</td>
                <td>{{ $author->name }}</td>
                <td>{{ $author->books_count }}</td>
            </tr>
        @empty
            <tr><td colspan="3">No authors yet.</td></tr>
        @endforelse
    </table>
@endsection