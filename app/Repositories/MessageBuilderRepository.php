<?php

namespace App\Repositories;

use CodeBot\Bot;
use App\Message;

class MessageBuilderRepository
{

    public function createMessage(Bot $bot, Message $message)
    {
        if ($message->template) { } else {
            $bot->message($message->type, $message->message);
        }
    }
}
