<?php
declare(strict_types=1);

namespace eclectic\App;

use KHerGe\JSON\Exception\Decode\SyntaxException;
use Respect\Validation\Validator as v;
use Psr\Http\Message\ResponseInterface;
use KHerGe\JSON\JSON;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Route;

class Validator
{
    protected $rules;
    protected $requestBody;
    protected $responseBody;
    protected $json;

    public function __construct(Rules $rules, RequestBody $requestBody, ResponseBody $responseBody, JSON $json)
    {
        $this->rules = $rules;
        $this->requestBody = $requestBody;
        $this->responseBody = $responseBody;
        $this->json = $json;
    }

    public function __invoke(Request $request, Response $response, callable $next): ResponseInterface
    {

        $body = (string)$request->getBody();
        if (strlen($body) > 0) {
            $mediaType = $request->getMediaType();
            if ($mediaType !== 'application/json') {
                return $response->withJson(['status' => 400, 'error' => "Invalid media type ($mediaType). Must be application/json"], 400);
            }

            try {
                $json = $this->json->decode($body, true);
            }
            catch (\Exception $exception)
            {
                if ($exception instanceof SyntaxException)
                {
                    return $response->withJson(['status' => 400, 'error' => 'Invalid JSON request.'], 400);
                } else {
                    return $response->withJson(['status' => 500, 'error' => $exception->getMessage()], 500);
                }
            }
        }

        $json = $json ?? [];
        $queryItems = $request->getQueryParams() ?? [];
        $json = array_merge($json, $queryItems);

        /** @var Route $route */
        $route = $request->getAttribute('route');
        if ($route instanceof Route) {
            $id = $route->getArgument('id');
            $this->requestBody->setId($id);
        }
        $this->requestBody->setData($json);

        return $next($request->
            withAttribute('RequestBody', $this->requestBody)->
            withAttribute('ResponseBody', $this->responseBody), $response);
    }
}
