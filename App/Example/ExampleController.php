<?php
declare(strict_types=1);

namespace eclectic\Example;

use eclectic\App\App;

class ExampleController
{
    public function __invoke(App $app): void
    {
        $app->get('/example/{id}', ExampleGetAction::class);
        $app->patch('/example[/{id}]', ExamplePatchAction::class);
    }
}
