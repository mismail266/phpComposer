<?php

namespace Console\App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PrintCustomerCommand extends Command
{
    protected function configure()
    {
        $this->setName('print-all-customer')
            ->setHelp('This command will print all customers information available in database!')
            ->setDescription('List all customers information');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            'Customer Data',
            '============',
            '',
        ]);

        $printCustomerData = new \Console\App\DatabaseClasses\DatabaseClass();

        if ($printCustomerData->getData()){
            return Command::SUCCESS;
        }else{
            return Command::FAILURE;
        }             }
}