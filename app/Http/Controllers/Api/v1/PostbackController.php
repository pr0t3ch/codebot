<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiControllerTrait;
use App\Http\Controllers\Controller;
use App\Postback;

class PostbackController extends Controller
{

    use ApiControllerTrait;

    protected $model;

    public function __construct(Postback $model)
    {
        $this->model = $model;
    }
}
