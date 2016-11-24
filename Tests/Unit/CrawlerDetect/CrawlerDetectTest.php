<?php

namespace Nmure\CrawlerDetectBundle\Tests\Unit\CrawlerDetect;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Nmure\CrawlerDetectBundle\CrawlerDetect\CrawlerDetect;
use Symfony\Component\HttpFoundation\Request;

class CrawlerDetectTest extends TestCase
{
    private $browserUA = 'Mozilla/5.0 (X11; Fedora; Linux x86_64; rv:50.0) Gecko/20100101 Firefox/50.0';
    private $crawlerUA = 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)';

    public function testRequestNotFromACrawler()
    {
        $rsMock = $this->getRequestStackMockWithMasterRequest($this->browserUA);

        $crawlerDetect = new CrawlerDetect($rsMock);
        $this->assertFalse($crawlerDetect->isCrawler());

        // overriding the determined UA
        $this->assertTrue($crawlerDetect->isCrawler($this->crawlerUA));
    }

    public function testRequestFromACrawler()
    {
        $rsMock = $this->getRequestStackMockWithMasterRequest($this->crawlerUA);

        $crawlerDetect = new CrawlerDetect($rsMock);
        $this->assertTrue($crawlerDetect->isCrawler());

        // overriding the determined UA
        $this->assertFalse($crawlerDetect->isCrawler($this->browserUA));
    }

    public function testNoRequest()
    {
        $rsMock = $this->getRequestStackMock();
        $rsMock->expects($this->once())
            ->method('getMasterRequest')
            ->willReturn(null);

        $crawlerDetect = new CrawlerDetect($rsMock);
        // when the app is accessed from the CLI
        $this->assertFalse($crawlerDetect->isCrawler());

        // specifying the UA
        $this->assertFalse($crawlerDetect->isCrawler($this->browserUA));
        $this->assertTrue($crawlerDetect->isCrawler($this->crawlerUA));
    }

    private function getRequestStackMockWithMasterRequest($userAgent)
    {
        $rsMock = $this->getRequestStackMock();
        $rsMock->expects($this->once())
            ->method('getMasterRequest')
            ->willReturn(new Request(array(), array(), array(), array(), array(), array(
                'HTTP_USER_AGENT' => $userAgent,
            )));

        return $rsMock;
    }

    private function getRequestStackMock()
    {
        return $this->getMockBuilder('Symfony\Component\HttpFoundation\RequestStack')
            ->disableOriginalConstructor()
            ->getMock();
    }
}
