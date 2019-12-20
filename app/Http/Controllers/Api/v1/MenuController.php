<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiControllerTrait;
use App\Http\Controllers\Controller;
use App\Menu;
use CodeBot\Build\Solid;

class MenuController extends Controller
{
    use ApiControllerTrait;

    protected $model;
    protected $relationships = ['menu_buttons'];

    public function __construct(Menu $model)
    {
        $this->model = $model;
    }

    public function setMenu($menu_id)
    {
        $menu = Menu::findOrFail($menu_id);

        $bot =  Solid::factory();
        Solid::pageAccessToken(config('botfb.pageAccessToken'));

        $result =  $bot->addMenu($menu->locale, $menu->composer_input_disabled, $menu->menu_buttons);

        $menu->facebook_diff = false;
        $menu->save();

        return $result;
    }

    public function removeMenu()
    {
        $bot = Solid::factory();
        Solid::pageAccessToken(config('botfb.pageAccessToken'));

        return $bot->removeMenu();
    }
}
