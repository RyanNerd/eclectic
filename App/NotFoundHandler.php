<?php
declare(strict_types=1);

namespace eclectic\App;

use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class NotFoundHandler
{
    public function __invoke(Request $request, Response $response): ResponseInterface
    {
        /** @var ResponsePayload $responsePayload */
        $responsePayload = $request->getAttribute('ResponsePayload');
        $responsePayload->setStatus(404);
        $responsePayload->setData(null);
        return $response->withJson($responsePayload->build('Not Found'), 404);
    }
}
