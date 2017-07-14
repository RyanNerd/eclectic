<?php
declare(strict_types=1);

namespace eclectic\Example;

use eclectic\App\RequestPayload;
use eclectic\App\ResponsePayload;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * The convention for an Action Class file is: NameMethodAction.php (e.g. ExampleGetAction.php)
 */
class ExampleGetAction
{
    /**
     * @var ExampleGetHandler
     */
    protected $handler;

    /**
     * ExampleGetAction constructor.
     *
     * The convention for an Action constructor is to instantiate a handler from a handler class
     * called NameMethodHandler.php (e.g. ExampleGetHandler.php) and save the handler as a property.
     */
    function __construct(ExampleGetHandler $exampleGetHandler)
    {
        $this->handler = $exampleGetHandler;
    }

    /**
     * This class is invoked when the requested route pattern and HTTP method are requested:
     * (e.g. HTTP GET /example/test)
     */
    function __invoke(Request $request, Response $response): ResponseInterface
    {
        /**
         * @var RequestPayload $requestPayload
         */
        $requestPayload = $request->getAttribute('RequestPayload');

        /**
         * @var ResponsePayload $responsePayload
         */
        $responsePayload = $request->getAttribute('ResponsePayload');

        $handler = $this->handler;
        $data = $requestPayload->getData();
        $data = $handler($data);
        $responsePayload->setData($data);
        $responsePayload->setStatus(200);
        return $response->withJson($responsePayload->build(), 200);
    }
}
