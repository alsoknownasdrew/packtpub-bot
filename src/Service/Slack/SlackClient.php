<?php

declare(strict_types=1);

namespace PPBot\Service\Slack;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use PPBot\Exception\BookSendingErrorException;

class SlackClient implements SlackClientInterface
{
    /** @var ClientInterface */
    private $client;

    /** @var string */
    private $webHook;

    public function __construct(ClientInterface $client, string $webHook)
    {
        $this->client = $client;
        $this->webHook = $webHook;
    }

    /**
     * @throws BookSendingErrorException
     */
    public function send(string $message): void
    {
        $request = new Request(
            'POST',
            $this->webHook,
            ['Content-type' => 'application/json'],
            $message
        );

        try {
            $this->client->send($request);
        } catch (\Exception|GuzzleException $exception) {
            throw new BookSendingErrorException('Failed to send book data to slack', 500, $exception);
        }
    }
}
