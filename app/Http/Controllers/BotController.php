<?php

namespace App\Http\Controllers;

use CodeBot\CallSendApi;
use CodeBot\WebHook;
use CodeBot\SenderRequest;
use CodeBot\Message\Text;
use CodeBot\Element\Button;
use CodeBot\Element\Product;
use CodeBot\TemplatesMessage\ButtonsTemplate;
use CodeBot\TemplatesMessage\GenericTemplate;
use CodeBot\TemplatesMessage\ListTemplate;
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

        $text = new Text((int) $senderId);
        $callSendApi = new CallSendApi(config('botfb.pageAcessToken'));

        $callSendApi->make($text->message('Olá, voce digitou' . $message));
        // $callSendApi->make($text->message('Você digitou', $message));

        // $message = new ButtonsTemplate((int) $senderId);
        // $message->add(new Button('web_url', 'Google', 'https://www.google.com'));
        // $callSendApi->make($message->message('Texto do botão'));

        $product = new Product(
            'Produto',
            'https://www.idealmarketing.com.br/blog/wp-content/uploads/2018/09/marketing-de-produto-conceito.jpg',
            'Subtitulo do Produto',
            new Button('web_url', null, 'http://www.google.com')
        );
        $product2 = new Product(
            'Produto',
            'https://www.idealmarketing.com.br/blog/wp-content/uploads/2018/09/marketing-de-produto-conceito.jpg',
            'Subtitulo do Produto',
            new Button('web_url', null, 'http://www.google.com')
        );


        $template = new ListTemplate(1234);
        $template->add($product);
        $template->add($product2);

        $callSendApi->make($template->message('message'));

        // $product = new Product(
        //     'Produto',
        //     'https://www.idealmarketing.com.br/blog/wp-content/uploads/2018/09/marketing-de-produto-conceito.jpg',
        //     'Subtitulo do Produto',
        //     new Button('web_url', null, 'http://www.google.com')
        // );

        // $template = new GenericTemplate(1234);
        // $template->add($product);
        // $template->add($product);

        // $callSendApi->make($template->message('message'));


        return '';
    }
}
