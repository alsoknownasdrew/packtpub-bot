<?php

declare(strict_types=1);

namespace PPBot\Command;

use PPBot\Fetcher\BookFetcherInterface;
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

    /**
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $book = $this->bookFetcher->fetch();
            $this->bookSender->send($book);
        } catch (\Exception $exception) {
            throw new \RuntimeException('An error occured on book data loading or there are currently no free offers.');
        }
    }
}
