<?php

declare(strict_types=1);

namespace PPBot\Request;

use GuzzleHttp\Psr7\Request;

/**
 * Class SlackRequestFactory
 *
 * @package PPBot\Request
 */
class SlackRequestFactory
{
    /**
     * @var string
     */
    private $webHook;

    /**
     * SlackRequestFactory constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->webHook = $config['slack']['webhooks']['channel'];
    }

    /**
     * @param string $body
     *
     * @return Request
     */
    public function createRequest(string $body): Request
    {
        $method = 'POST';
        $headers = [
            'Content-type' => 'application/json',
        ];

        return new Request($method, $this->webHook, $headers, $body);
    }
}
