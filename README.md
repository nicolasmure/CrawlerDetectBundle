# CrawlerDetectBundle

[![Build Status](https://travis-ci.org/nicolasmure/CrawlerDetectBundle.svg?branch=master)](https://travis-ci.org/nicolasmure/CrawlerDetectBundle)
[![Coverage Status](https://coveralls.io/repos/github/nicolasmure/CrawlerDetectBundle/badge.svg?branch=master)](https://coveralls.io/github/nicolasmure/CrawlerDetectBundle?branch=master)

A Symfony bundle for the [Crawler-Detect](https://github.com/JayBizzle/Crawler-Detect "JayBizzle/Crawler-Detect")
library (detects bots/crawlers/spiders via the user agent).

## Table of contents

- [Introduction](#introduction)
- [Installation](#installation)
- [Usage](#usage)
- [Testing](#testing)

## Introduction

This Bundle integrates the [Crawler-Detect](https://github.com/JayBizzle/Crawler-Detect "JayBizzle/Crawler-Detect")
library into Symfony.
It is **recommended** to read the lib's documentation before continuing here.

The aim of this bundle is to expose the [`CrawlerDetect`](https://github.com/JayBizzle/Crawler-Detect/blob/master/src/CrawlerDetect.php "Jaybizzle\CrawlerDetect\CrawlerDetect")
class as a service (`crawler_detect`) to make it easier to use with Symfony
(dependency injection, usable from a controller, etc...).

## Installation

Download the bundle using composer :

```bash
$ composer require nmure/crawler-detect-bundle "^2.0.0"
```

For Symfony < 4.0, run :

```bash
$ composer require nmure/crawler-detect-bundle "^1.0.0"
```

then enable the bundle in your AppKernel :

```php
// app/AppKernel.php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Nmure\CrawlerDetectBundle\CrawlerDetectBundle(),
            // ...
        );
    }
}
```

## Usage

The `crawler_detect` service is initialized with the data from
the Symfony's master request.

To use this service from a controller :

```php
public function indexAction()
{
    if ($this->get('crawler_detect')->isCrawler()) {
        // this request is from a crawler :)
    }

    // you can also specify an user agent if you don't want
    // to use the one of the master request or if the app
    // is accessed by the CLI :
    $ua = 'Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)';
    if ($this->get('crawler_detect')->isCrawler($ua)) {
        // this user agent belongs to a crawler :)
    }
}
```

You can also inject this service as a dependency
using the `crawler_detect` service id.

## Testing

```bash
$ docker run --rm -v `pwd`:/app phpunit/phpunit -c /app
```
