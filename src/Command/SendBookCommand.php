<?php

declare(strict_types=1);

namespace PPBot\Command;

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
    protected function configure(): void
    {
        $this->setName('send-book')
            ->setDescription('Sends the latest Packt Publishing Free eBbook to specified in .env Slack channel.')
            ->setHelp('Sends the latest Packt Publishing Free eBbook to specified in .env Slack channel.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $message = "Today's free book: https://www.packtpub.com/packt/offers/free-learning";
        
        $output->writeln($message);
    }
}
