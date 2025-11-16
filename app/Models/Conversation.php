<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function ad()
    {
        return $this->belongsTo(Ad::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    // Helper to get the other user in the conversation
    public function otherUser()
    {
        return $this->sender_id === auth()->id() ? $this->receiver : $this->sender;
    }

    // Helper to get the last message for the conversation list
    public function lastMessage()
    {
        return $this->hasOne(Message::class)->latest();
    }
}