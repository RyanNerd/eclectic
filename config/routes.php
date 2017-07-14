<?php
declare(strict_types=1);

use eclectic\Example\ExampleGetAction;

/**
 * The convention for routes is that each route http method (get, patch, etc) is mapped to an Action.
 * See the ExampleGetAction.php file.
 */
return
[
    'routes' =>
    [
        'get' =>
        [
            '/example/{id}' => ExampleGetAction::class,
            '/echo/{id}' => ExampleGetAction::class
        ]
    ]
];