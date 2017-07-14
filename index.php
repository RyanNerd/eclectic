<?php
declare(strict_types=1);

namespace
{
    use eclectic\App\App;
    use Dotenv\Dotenv;

    require_once(__DIR__ . '/vendor/autoload.php');

    $dotEnv = new Dotenv(__DIR__);
    $dotEnv->load();

    $app = new App();
    $app->run();
}