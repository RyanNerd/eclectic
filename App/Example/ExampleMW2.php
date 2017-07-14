<?php
declare(strict_types=1);

namespace eclectic\Example;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class ExampleMW2
 *
 * Executed BEFORE ExampleMW1
 */
class ExampleMW2
{
    function __construct()
    {
        // TODO: Use PHP-DI to construct any needed dependencies
        // Perhaps load a database object
    }

    function __invoke(Request $request, Response $response, callable $next): ResponseInterface
    {


        /* EXAMPLE

        $requestPayload = $request->getAttribute('RequestPayload');

        // Perhaps use the loaded database object to authenticate the request.
        if (isset($requestPayload['authkey']) && $requestPayload['authkey'] = 'somedatabasequery')
        {
            // All is well so continue to process any middleware and routes.
            return $next($request, $response);
        } else {
            $responsePayload = $request->getAttribute('ResponsePayload');
            $responsePayload->setData(null);
            $responsePayload->setStatus(401);
            $data = $responsePayload->build();
            return $response->withJson($data, 401); // Since we didn't call $next no further processing will occur.
        }
        */

        return $next($request, $response);
    }
}