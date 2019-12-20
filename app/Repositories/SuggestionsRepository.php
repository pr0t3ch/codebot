<?php

namespace App\Repositories;

use App\Suggestions;
use Illuminate\Support\Facades\Redis;

class SuggestionsRepository
{
    public function statusStart($senderId)
    {
        Redis::set('suggestion::start::' . $senderId, 'started');
    }

    public function statusCheck($senderId)
    {
        Redis::get('suggestion::start::' . $senderId, 'started');
    }

    public function statusStop($senderId)
    {
        Redis::del('suggestion::start::' . $senderId, 'started');
    }

    public function createSuggestion($senderId, $message)
    {
        Suggestions::create([
            'user_face_id' => $senderId,
            'suggestion' => $message
        ]);
    }
}
