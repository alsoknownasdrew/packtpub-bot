<?php

declare(strict_types=1);

namespace PPBot\Command;

use GuzzleHttp\Exception\GuzzleException;
use PPBot\Consumer\SlackConsumer;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SendBookCommand
 *
 * @package PPBot\Command
 */
class SendBookCommand extends Command
{
    /**
     * @var SlackConsumer
     */
    private $slackConsumer;

    /**
     * SendBookCommand constructor.
     *
     * @param SlackConsumer $slackConsumer
     */
    public function __construct(SlackConsumer $slackConsumer)
    {
        $this->slackConsumer = $slackConsumer;

        parent::__construct();
    }

    protected function configure(): void
    {
        $description = 'Sends the latest Packt Publishing Free eBook to specified in .env Slack channel.';

        $this->setName('send-book')
            ->setDescription($description)
            ->setHelp($description);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        try {
            $this->slackConsumer->sendBookMessage();
        } catch (GuzzleException $exception) {
            throw new RuntimeException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}
