<?php
declare(strict_types=1);

namespace eclectic\Example;

class ExampleGetHandler
{
    // Handler just echos back the given array.
    function __invoke(array $data): array
    {
        return $data;
    }
}
