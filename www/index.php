<?php

declare(strict_types=1);

// absolute filesystem path to the web root

define('WWW_DIR', __DIR__);

// absolute filesystem path to the temporary files
define('TEMP_DIR', WWW_DIR . '/../temp');

//uploaded files
define('UPLOAD_DIR', WWW_DIR . '/uploads');

//components directory
define ('COMPONENTS_DIR',__DIR__.'/../app/Components');

require __DIR__ . '/../vendor/autoload.php';




$configurator = App\Bootstrap::boot();
$container = $configurator->createContainer();
$application = $container->getByType(Nette\Application\Application::class);
$application->run();
