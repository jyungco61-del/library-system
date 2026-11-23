@extends('layouts.app')

@section('content')
    <h2>Members</h2>

    <form action="{{ route('members.store') }}" method="POST">
        @csrf
        @formToken
        <input type="text" name="name" placeholder="Full name" value="{{ old('name') }}" required>
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
        <button type="submit">Add Member</button>
    </form>

    <table>
        <tr><th>#</th><th>Name</th><th>Email</th><th>Library Card</th></tr>
        @forelse ($members as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td>{{ $member->name }}</td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->libraryCard->card_number ?? 'No card yet' }}</td>
            </tr>
        @empty
            <tr><td colspan="4">No members yet.</td></tr>
        @endforelse
    </table>
@endsection