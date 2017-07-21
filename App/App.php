<?php

namespace eclectic\App;

use DI\ContainerBuilder;
use Slender\App as Slender;

class App extends Slender
{
    protected const ALLOWED_METHODS = ['get', 'post', 'put', 'delete', 'head', 'patch', 'options'];
    /**
     * App constructor.
     * Establish DI
     * Set up Group and Route Mappings, and Initialization middleware
     */
    public function __construct()
    {
        parent::__construct();

        $container = $this->getContainer();

        // Map groups to controllers
        $groups = $container->get('groups') ?? [];
        foreach ($groups as $groupPath => $controllers) {
            $this->group($groupPath, function () use ($container, $controllers) {
                foreach ($controllers as $controller) {
                    $container->get($controller)($this);
                }
            });
        }

        // Map individual routes to Actions
        $routes = $container->get('routes') ?? [];
        $allowedMethods = $container->has('allowedMethods') ?
            $container->get('allowedMethods') : self::ALLOWED_METHODS;
        foreach ($routes as $method => $routing) {
            if (in_array($method, $allowedMethods)) {
                foreach ($routing as $path => $action) {
                    $this->$method($path, $action);
                }
            }
        }

        // Middleware mapping
        $mw = $container->get('mw') ?? [];
        ksort($mw);
        foreach ($mw as $priority => $class) {
            $this->add($class);
        }

        // LIFE (Last In First Executed) - Executed first to establish RequestPayload and ResponsePayload objects.
        $this->add(Initializer::class);
    }

    /**
     * Grab the DI configurations from the config directory.
     */
    protected function configureContainer(ContainerBuilder $builder)
    {
        foreach (glob(__DIR__ . '/../config/*.php', GLOB_NOSORT) as $definitions) {
            $builder->addDefinitions(realpath($definitions));
        }
    }
}
