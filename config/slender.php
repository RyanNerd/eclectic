<?php
declare(strict_types=1);

use eclectic\App\NotFoundHandler;
use eclectic\App\NotAllowedHandler;
use function DI\object;
use function DI\get;
return
[
    NotFoundHandler::class => object()->constructor(),
    notAllowedHandler::class => object()->constructor(),
    'settings.displayErrorDetails' => (getenv('DEVELOPMENT') === 'true' || getenv('DEVELOPMENT') === 'TRUE') ? true : false,
    'settings.determineRouteBeforeAppMiddleware' => true,
    'notFoundHandler' => get(NotFoundHandler::class),
    'notAllowedHandler' => get(NotAllowedHandler::class)
];
