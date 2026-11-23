<?php

namespace App\Http\Controllers;

use App\Models\LibraryCard;
use App\Models\Member;
use Illuminate\Http\Request;

class LibraryCardController extends Controller
{
    public function index()
    {
        $cards = LibraryCard::with('member')->latest()->get();
        
        $members = Member::doesntHave('libraryCard')->orderBy('name')->get();
        return view('library-cards.index', compact('cards', 'members'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'member_id' => 'required|exists:members,id|unique:library_cards,member_id',
            'card_number' => 'required|string|max:50|unique:library_cards,card_number',
            'issued_date' => 'required|date',
        ]);
        LibraryCard::create($data);
        return redirect()->route('library-cards.index')->with('success', 'Library card added.');
    }
}