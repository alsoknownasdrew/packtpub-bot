<?php

declare(strict_types=1);

namespace PPBot\Consumer;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use PPBot\Request\SlackRequestFactory;

/**
 * Class SlackClient
 *
 * @package PPBot\Client
 */
class SlackConsumer
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var SlackRequestFactory
     */
    private $requestFactory;

    /**
     * SlackConsumer constructor.
     *
     * @param Client $client
     * @param SlackRequestFactory $requestFactory
     */
    public function __construct(Client $client, SlackRequestFactory $requestFactory)
    {
        $this->client = $client;
        $this->requestFactory = $requestFactory;
    }

    /**
     * @param string $body
     */
    public function sendMessage(string $body): void
    {
        $request = $this->requestFactory->createRequest($body);

        try {
            $this->client->send($request);
        } catch (GuzzleException $e) {
            throw new \RuntimeException('Error: Couldn\'t send message to Slack.', $e->getCode(), $e);
        }
    }
}
