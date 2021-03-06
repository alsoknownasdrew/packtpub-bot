<?php

declare(strict_types=1);

namespace PPBot\Sender;

use PPBot\Entity\Book;
use PPBot\Service\BookToSlackMessageConverter;
use PPBot\Service\Slack\SlackClientInterface;

class SlackBookSender implements BookSenderInterface
{
    /** @var BookToSlackMessageConverter */
    private $bookToSlackMessageConverter;

    /** @var SlackClientInterface */
    private $slackClient;

    public function __construct(SlackClientInterface $slackClient, BookToSlackMessageConverter $bookToSlackMessageConverter)
    {
        $this->bookToSlackMessageConverter = $bookToSlackMessageConverter;
        $this->slackClient = $slackClient;
    }

    public function send(Book $book): void
    {
        $message = $this->bookToSlackMessageConverter->convert($book);
        $this->slackClient->send($message);
    }
}
