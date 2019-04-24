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
     * @throws GuzzleException
     */
    public function sendBookMessage(): void
    {
        $body = \GuzzleHttp\json_encode(['text' => "Today's free book: https://www.packtpub.com/packt/offers/free-learning!"]);
        $request = $this->requestFactory->createRequest($body);

        $this->client->send($request);
    }
}
