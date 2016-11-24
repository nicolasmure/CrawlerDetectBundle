<?php

namespace Nmure\CrawlerDetectBundle\CrawlerDetect;

use Jaybizzle\CrawlerDetect\CrawlerDetect as BaseCrawlerDetect;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class extending the BaseCrawlerDetect to adapt it for Symfony.
 */
class CrawlerDetect extends BaseCrawlerDetect
{
    /**
     * Initialise the BaseCrawlerDetect using the master request
     * from the $requestStack.
     *
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        if ($request = $requestStack->getMasterRequest()) {
            // the app is accessed by a HTTP request
            $headers = $request->server->all();
            $userAgent = $request->headers->get('User-Agent');
        } else {
            // the app is accessed by the CLI
            $headers = $userAgent = null;
        }

        parent::__construct($headers, $userAgent);
    }
}
