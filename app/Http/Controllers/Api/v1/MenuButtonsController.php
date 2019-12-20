<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiControllerTrait;
use App\Http\Controllers\Controller;
use App\MenuButtons;

class MenuButtonsController extends Controller
{
    use ApiControllerTrait;

    protected $model;

    public function __construct(MenuButtons $model)
    {
        $this->model = $model;
    }
}
