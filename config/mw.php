<?php
declare(strict_types=1);

use eclectic\Example\ExampleMW1;
use eclectic\Example\ExampleMW2;

/**
 * Middleware is declared as:
 * priority => class, ...
 * Where the higher the priority the class will be invoked before others of a lower priority.
 */
return
[
    'mw' =>
    [
        0 => ExampleMW1::class,
        1 => ExampleMW2::class
    ]
];


