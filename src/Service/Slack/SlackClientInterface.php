<?php

declare(strict_types=1);

namespace PPBot\Service\Slack;

interface SlackClientInterface
{
    public function send(string $message): void;
}