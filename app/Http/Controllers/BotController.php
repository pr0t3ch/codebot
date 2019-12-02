<?php

namespace App\Http\Controllers;

use CodeBot\CallSendApi;
use CodeBot\WebHook;
use CodeBot\SenderRequest;
use CodeBot\Message\Text;
use CodeBot\Element\Button;
use CodeBot\TemplatesMessage\ButtonsTemplate;
use Illuminate\Http\Request;

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

        $text = new Text($senderId);
        $callSendApi = new CallSendApi(config('botfb.pageAcessToken'));

        $callSendApi->make($text->message('Olá, voce digitou' . $message));
        // $callSendApi->make($text->message('Você digitou', $message));

        $message = new ButtonsTemplate($senderId);
        $message->add(new Button('web_url', 'Google', 'https://www.google.com'));
        $callSendApi->make($message->message('Texto do botão'));


        return '';
    }
}
