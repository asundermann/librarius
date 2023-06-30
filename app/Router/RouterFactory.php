<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList;

//        ADMIN MODULE
        $router->withModule('Admin')
        ->addRoute('prihlaseni','Login:default')

        ->addRoute('prehled', 'BookOverview:default')
        ->addRoute('prehled/detail-knihy[/<id>]', 'BookOverview:detail')

        ->addRoute('o-projektu', 'About:default')

        ->addRoute('knihy', 'Books:default')
        ->addRoute('nahrat-knihu', 'Books:add')
        ->addRoute('editovat-knihu[/<id>]', 'Books:edit')

        ->addRoute('uzivatele', 'Users:default')
        ->addRoute('pridat-uzivatele', 'Users:add')
        ->addRoute('editovat-uzivatele[/<id>]', 'Users:edit')

        //Default route
        ->addRoute('<presenter>/<action>[/<id>]', 'Login:default');


///     I dont need it for now
///         FRONT MODULE
//        $router->withModule('Front')
//		        ->addRoute('<presenter>/<action>[/<id>]', 'Main:default');

		return $router;
	}
}
