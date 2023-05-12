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
               ->addRoute('admin/<presenter>/<action>[/<id>]', 'Login:default');

//        FRONT MODULE
		$router->addRoute('<presenter>/<action>[/<id>]', 'Main:default');

		return $router;
	}
}
