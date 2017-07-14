<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{
    public function testInvalidProperty()
    {
        $this->expectException(\PHPUnit\Framework\Error\Notice::class);

        /** @var \eclectic\App\App $app */
        $app = $this->getMockBuilder(\eclectic\App\App::class)->disableOriginalConstructor()->getMock();
        $badProperty = 'bogus';
        $value = $app->$badProperty;
    }
}

