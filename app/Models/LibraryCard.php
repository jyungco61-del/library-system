<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibraryCard extends Model
{
    protected $fillable = ['member_id', 'card_number', 'issued_date'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}