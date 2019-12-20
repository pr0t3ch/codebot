<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiControllerTrait;
use App\Http\Controllers\Controller;
use App\Suggestions;

class SuggestionController extends Controller
{

    use ApiControllerTrait;

    protected $model;

    public function __construct(Suggestions $model)
    {
        $this->model = $model;
    }
}
