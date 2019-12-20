<?php

namespace App\BotResources;

use App\Repositories\SuggestionsRepository;
use CodeBot\Resources\ResourceInterface;

class SendSuggestions implements ResourceInterface
{
    public function __invoke(\CodeBot\SenderRequest $sender, \CodeBot\Bot $bot): bool
    {

        $suggestion = new SuggestionsRepository;

        if ($suggestion->statusCheck($sender->getSenderId()) === 'started') {
            $suggestion->createSuggestion($sender->getSenderId(), $sender->getMessage());

            $bot->message('text', 'Obrigado pela sugestão');
            $suggestion->statusStop($sender->getSenderId());

            return true;
        }

        return false;
    }

    public function statusStart(\CodeBot\SenderRequest $sender, \CodeBot\Bot $bot)
    {
        (new SuggestionsRepository)->statusStart($sender->getSenderId());

        $bot->message('text', 'Ok, qual a sua sugestão?');
        $bot->message('text', 'Envie todas as sugestões de uma vez só.');
    }
}
