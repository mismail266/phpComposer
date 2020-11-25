<?php

namespace Console\App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class SearchCustomerCommand extends Command
{
    protected function configure()
    {
        $this->setName('search-customer-by-name')
            ->setHelp('This command will search customer by name from database!')
            ->setDescription('Customer information')
            ->addArgument('customerName', InputArgument::IS_ARRAY | InputArgument::REQUIRED, 'Customer name: ');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $searchString = null;
        $customerName = $input->getArgument('customerName');

        if (count($customerName) > 0) {
            $searchString .= implode(' ', $customerName);
        }

        $output->writeln([
            'Customer Data',
            '============',
            '',
        ]);

        $printCustomerByName = new \Console\App\DatabaseClasses\DatabaseClass();

        if ($printCustomerByName->getCustomerByName($searchString)){
            return Command::SUCCESS;
        }else{
            return Command::FAILURE;
        }
    }
}