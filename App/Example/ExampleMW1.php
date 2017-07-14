<?php
declare(strict_types=1);

namespace eclectic\Example;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class ExampleMW1
 *
 * Executed AFTER ExampleMW2
 */
class ExampleMW1
{
    function __construct()
    {
        // TODO: Use PHP-DI to construct any needed dependencies
    }

    function __invoke(Request $request, Response $response, callable $next): ResponseInterface
    {
        // TODO: Implement __invoke() method.
        return $next($request, $response);
    }
}

