<?php
declare(strict_types=1);

namespace eclectic\App;

use KHerGe\JSON\JSON;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Route;

class Initializer
{
    protected $requestPayload;
    protected $responsePayload;
    protected $JSON;

    function __construct(RequestPayload $requestPayload, ResponsePayload $responsePayload, JSON $JSON)
    {
        $this->requestPayload = $requestPayload;
        $this->responsePayload = $responsePayload;
        $this->JSON = $JSON;
    }

    function __invoke(Request $request, Response $response, callable $next): ResponseInterface
    {
        $responsePayload = $this->responsePayload;

        /** @var Route $route */
        $route = $request->getAttribute('route');

        // If the route is null then pass through to the notFoundHandler
        if ($route === null) {
            return $next($request->withAttribute('ResponsePayload', $responsePayload), $response);
        }

        $id = $route->getArgument('id') ?? '';
        $queryParams = $request->getQueryParams() ?? [];

        $bodyArray = [];
        $body = (string)$request->getBody() ?? "";
        if (strlen($body) !== 0) {
            try {
                $bodyArray = $this->JSON->decode($body, true);
            } catch (\Exception $exception) {
                $responsePayload->setStatus(400);
                $responsePayload->setData(null);
                return $response->withJson($responsePayload->build('Invalid JSON'), 400);
            }
        }

        $requestArray = array_merge(['id' => $id], $queryParams, $bodyArray);
        $this->requestPayload->setData($requestArray);
        return $next($request->
            withAttribute('RequestPayload', $this->requestPayload)->
            withAttribute('ResponsePayload', $this->responsePayload), $response);
    }
}

