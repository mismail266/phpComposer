<?php

namespace Console\App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class AddCustomerCommand extends Command
{
    protected function configure()
    {
        $this->setName('add-new-customer')
            ->setHelp('This command will add a new customer in system')
            ->setDescription('Add new customer in database');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $customerName = readline('Customer Name: ');
        $address = readline('Address: ');
        $city = readline('City: ');
        $postalCode = readline('PostalCode: ');
        $country = readline('Country: ');

        $addCustomerData = new \Console\App\DatabaseClasses\DatabaseClass();

        if ($addCustomerData->insertData($customerName, $address, $city, $postalCode, $country)){
            echo "Data Inserted!" ;
            return Command::SUCCESS;
        }else{
            echo "Data not inserted" ;
            return Command::FAILURE;
        }
    }
} 