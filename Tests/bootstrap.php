<?php

include __DIR__.'/Functional/Fixtures/app/AppKernel.php';

if (!is_file($autoloadFile = __DIR__ . '/../vendor/autoload.php')) {
    throw new \LogicException('Could not find autoload.php in vendor/. Try to run "composer install"');
}

require $autoloadFile;
