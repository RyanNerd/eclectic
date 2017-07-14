<?php
declare(strict_types=1);

namespace eclectic\Example;

use eclectic\App\RequestPayload;
use eclectic\App\ResponsePayload;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class ExamplePatchAction
{
    function __invoke(Request $request, Response $response): ResponseInterface
    {
        /** @var RequestPayload $requestPayload */
        $requestPayload = $request->getAttribute('RequestPayload');

        /** @var ResponsePayload $responsePayload */
        $responsePayload = $request->getAttribute('ResponsePayload');

        $hello = $requestPayload['id'];
        $data = $requestPayload->getData();
        $data['hello'] = $hello;

        $responsePayload->setData($data);
        $responsePayload->setStatus(200);
        return $response->withJson($responsePayload->build(), 200);
    }
}
