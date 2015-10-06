<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use AppBundle\Controller\FreelanceController;

class MailToAuthorCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('mail:author')
            ->setDescription('Send an email to the writer of an article if he has notifications from more than 24 hours.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        // todo: find the author email of an article if he has notifications from more than 24 hours

        $output->writeln('Email is sent');
    }

}