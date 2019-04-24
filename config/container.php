<?php

declare(strict_types=1);

use League\Container\Container;

$container = new Container;

$config = require __DIR__ . '/config.php';

$container->add(\GuzzleHttp\Client::class);
$container->add(\PPBot\Request\SlackRequestFactory::class)->addArgument($config);

$container->add(\PPBot\Consumer\SlackConsumer::class)
    ->addArgument(\GuzzleHttp\Client::class)
    ->addArgument(\PPBot\Request\SlackRequestFactory::class);

$container->add(\PPBot\Command\SendBookCommand::class)->addArgument(\PPBot\Consumer\SlackConsumer::class);

return $container;
