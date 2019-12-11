<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiControllerTrait;
use App\Http\Controllers\Controller;
use App\Message;

class MessageController extends Controller
{

    use ApiControllerTrait;

    protected $model;

    public function __construct(Message $model)
    {
        $this->model = $model;
    }
}
