<?php
declare(strict_types=1);

namespace eclectic\App;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class NotAllowedHandler
{
    function __invoke(Request $request, Response $response): ResponseInterface
    {
        /** @var ResponsePayload $responsePayload */
        $responsePayload = $request->getAttribute('ResponsePayload');
        $responsePayload->setStatus(405);
        $responsePayload->setData(null);
        return $response->withJson($responsePayload->build($request->getMethod() . ' Not Allowed'), 404);
    }
}


