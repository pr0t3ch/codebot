<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiControllerTrait;
use App\Http\Controllers\Controller;
use App\Element;

class ElementsController extends Controller
{

    use ApiControllerTrait;

    protected $model;

    public function __construct(Element $model)
    {
        $this->model = $model;
    }
}
