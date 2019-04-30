<?php

declare(strict_types=1);

use League\Container\Container;

$container = new Container;

$config = require __DIR__ . '/config.php';

/**
 * Application dependencies
 */
$container->add(\GuzzleHttp\Client::class);

/**
 * Core components
 */
$container->add(\PPBot\Request\SlackRequestFactory::class)->addArgument($config);

$container->add(\PPBot\Consumer\SlackConsumer::class)
    ->addArgument(\GuzzleHttp\Client::class)
    ->addArgument(\PPBot\Request\SlackRequestFactory::class);

$container->add(\PPBot\Command\SendBookCommand::class)->addArgument(\PPBot\Consumer\SlackConsumer::class);

$container->add(\Symfony\Component\Console\Application::class, function() use ($container) {
    $app = new \Symfony\Component\Console\Application();
    $app->add($container->get(\PPBot\Command\SendBookCommand::class));

    return $app;
});

return $container;
