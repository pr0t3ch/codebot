<?php

namespace App\Http\Controllers;

use CodeBot\SenderRequest;
use CodeBot\Element\Button;
use CodeBot\Element\Product;
use CodeBot\WebHook;
use Illuminate\Http\Request;
use CodeBot\Build\Solid;

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
        $message = $sender->getMessage();
        $postback = $sender->getPostBack();

        $bot = Solid::factory();
        Solid::pageAccessToken(config('botfb.pageAccessToken'));
        Solid::setSender($senderId);


        return '';
    }
}
