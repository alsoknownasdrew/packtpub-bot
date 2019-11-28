<?php

declare(strict_types=1);

namespace PPBot\Command;

use PPBot\Book\Fetcher\BookFetcherInterface;
use PPBot\Sender\BookSenderInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SendBookCommand extends Command
{
    /** @var BookFetcherInterface */
    private $bookFetcher;

    /** @var BookSenderInterface */
    private $bookSender;

    public function __construct(BookFetcherInterface $bookFetcher, BookSenderInterface $bookSender)
    {
        $this->bookFetcher = $bookFetcher;
        $this->bookSender = $bookSender;

        parent::__construct();
    }

    protected function configure(): void
    {
        $description = 'Sends the latest Packt Publishing Free eBook to specified in .env Slack channel.';

        $this->setName('send')
            ->setDescription($description)
            ->setHelp($description);
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $book = $this->bookFetcher->fetch();
        $this->bookSender->send($book);
    }
}
