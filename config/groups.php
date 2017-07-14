<?php
declare(strict_types=1);

use function DI\object;
use eclectic\Example\ExampleController;

/**
 * The convention for groups is that each group is "mapped"
 * to a controller that registers the routes for the group.
 * See the ExampleController.php file.
 */
return
[
    'groups' =>
    [
        '/v1' => [ExampleController::class]
    ]
];

