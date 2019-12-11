<?php

namespace App\Http\Controllers;

use CodeBot\SenderRequest;
use CodeBot\WebHook;
use Illuminate\Http\Request;
use CodeBot\Build\Solid;
use App\Postback;
use App\Repositories\MessageBuilderRepository;

class BotController extends Controller
{

    public function subscribe()
    {
        $webhook = new WebHook;
        $subscribe = $webhook->check(config('botfb.validationToken'));
        if (!$subscribe) {
            abort(403, 'Unauthorized action');
        }
        return $subscribe;
    }

    public function receiveMessage(Request $request)
    {
        $sender = new SenderRequest;
        $senderId = $sender->getSenderId();
        $postback = $sender->getPostBack();

        $bot = Solid::factory();
        Solid::pageAccessToken(config('botfb.pageAccessToken'));
        Solid::setSender($senderId);

        $postback = Postback::where('value', $postback)->first();

        foreach ($postback->messages as $message) {
            (new MessageBuilderRepository)->createMessage($bot, $message);
        }

        return '';
    }
}
