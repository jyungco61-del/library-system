@extends('layouts.app')

@section('content')
    <h2>Library Cards</h2>

    <form action="{{ route('library-cards.store') }}" method="POST">
        @csrf
        @formToken
        <select name="member_id" required>
            <option value="">-- Select Member --</option>
            @foreach ($members as $member)
                <option value="{{ $member->id }}" @selected(old('member_id') == $member->id)>{{ $member->name }}</option>
            @endforeach
        </select>
        <input type="text" name="card_number" placeholder="Card number" value="{{ old('card_number') }}" required>
        <input type="date" name="issued_date" value="{{ old('issued_date', date('Y-m-d')) }}" required>
        <button type="submit">Add Card</button>
    </form>

    <table>
        <tr><th>#</th><th>Member</th><th>Card Number</th><th>Issued Date</th></tr>
        @forelse ($cards as $card)
            <tr>
                <td>{{ $card->id }}</td>
                <td>{{ $card->member->name }}</td>
                <td>{{ $card->card_number }}</td>
                <td>{{ $card->issued_date }}</td>
            </tr>
        @empty
            <tr><td colspan="4">No library cards yet.</td></tr>
        @endforelse
    </table>
@endsection