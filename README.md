# CrawlerDetectBundle

[![Build Status](https://travis-ci.org/nicolasmure/CrawlerDetectBundle.svg?branch=master)](https://travis-ci.org/nicolasmure/CrawlerDetectBundle)
[![Coverage Status](https://coveralls.io/repos/github/nicolasmure/CrawlerDetectBundle/badge.svg?branch=master)](https://coveralls.io/github/nicolasmure/CrawlerDetectBundle?branch=master)

A Symfony bundle for the [Crawler-Detect](https://github.com/JayBizzle/Crawler-Detect)
library (detects bots/crawlers/spiders via the user agent).

## Table of contents

- [Introduction](#introduction)
- [Installation](#installation)
    - [Step 1 : Download the Bundle](#step-1--download-the-bundle)
    - [Step 2 : Enable the Bundle](#step-2--enable-the-bundle)
- [Usage](#usage)
- [Testing](#testing)

## Introduction

This Bundle integrates the [Crawler-Detect](https://github.com/JayBizzle/Crawler-Detect) library into Symfony.
It is **recommended** to read the lib's documentation before continuing here.

The aim of this bundle is to expose the [`CrawlerDetect`](https://github.com/JayBizzle/Crawler-Detect/blob/master/src/CrawlerDetect.php "Jaybizzle\CrawlerDetect\CrawlerDetect")
class as a service (`crawler_detect`) to make it easier to use with Symfony
(dependency injection, usable from a controller, etc...).

## Installation

### Step 1 : Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require nmure/crawler-detect-bundle "dev-master"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 2 : Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

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

From a controller :
```php
public function indexAction()
{
    if ($this->get('crawler_detect')->isCrawler()) {
        // crawler user-agent detected :)
    }
}
```

or you can also inject this service as a dependency
using the `crawler_detect` service id.

## Testing

```bash
$ docker run --rm -v `pwd`:/app phpunit/phpunit -c /app
```
