<?php

declare(strict_types=1);

use League\Container\Container;

$container = new Container;

$config = require __DIR__ . '/config.php';

/**
 * Application dependencies
 */
$container->add(\GuzzleHttp\ClientInterface::class, \GuzzleHttp\Client::class);

/**
 * Core components
 */
$container->add(\PPBot\Service\PacktPub\PacktPubClientInterface::class, \PPBot\Service\PacktPub\PacktPubClient::class)
    ->addArgument(\GuzzleHttp\ClientInterface::class);

$container->add(\PPBot\Service\Slack\SlackClientInterface::class, \PPBot\Service\Slack\SlackClient::class)
    ->addArgument(\GuzzleHttp\ClientInterface::class)
    ->addArgument($config['slack']['webhooks']['channel']);

$container->add(\PPBot\Service\BookToSlackMessageConverter::class);

$container->add(\PPBot\Book\Builder\BookBuilder::class);

$container->add(\PPBot\Book\Fetcher\BookFetcherInterface::class, \PPBot\Book\Fetcher\BookAPIFetcher::class)
    ->addArgument(\PPBot\Service\PacktPub\PacktPubClientInterface::class)
    ->addArgument(\PPBot\Book\Builder\BookBuilder::class);

$container->add(\PPBot\Sender\BookSenderInterface::class, \PPBot\Sender\SlackBookSender::class)
    ->addArgument(\PPBot\Service\Slack\SlackClientInterface::class)
    ->addArgument(\PPBot\Service\BookToSlackMessageConverter::class);

$container->add(\PPBot\Command\SendBookCommand::class)
    ->addArgument(\PPBot\Book\Fetcher\BookFetcherInterface::class)
    ->addArgument(\PPBot\Sender\BookSenderInterface::class);

$container->add(\Symfony\Component\Console\Application::class, static function () use ($container) {
    $app = new \Symfony\Component\Console\Application();
    $app->add($container->get(\PPBot\Command\SendBookCommand::class));

    return $app;
});

return $container;
