<?php

namespace Nmure\CrawlerDetectBundle\Tests\Functional\DependencyInjection;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CrawlerDetectExtensionTest extends KernelTestCase
{
    private $container;

    protected function setUp()
    {
        self::bootKernel();
        $this->container = static::$kernel->getContainer();
    }

    protected function tearDown()
    {
        unset($this->container);
    }

    public function testServiceIsDefined()
    {
        $this->assertInstanceOf('Jaybizzle\\CrawlerDetect\\CrawlerDetect', $this->container->get('crawler_detect'));
    }
}
