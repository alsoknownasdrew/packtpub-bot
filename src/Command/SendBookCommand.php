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
        $description = 'Sends the latest Packt Publishing Free eBbook to specified in .env Slack channel.';

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
        $message = "Today's free book: https://www.packtpub.com/packt/offers/free-learning";
        
        $output->writeln($message);
    }
}
