<?php

namespace Console\App\DatabaseClasses;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

class DatabaseClass
{
  var $connection;
  var $queryBuilder;

    public function __construct()
    {
        $config = new Configuration();

        $connectionParams = array(
            'url' => 'mysql://root:root@localhost/blueskytask1',
        );

        $this->connection = DriverManager::getConnection($connectionParams, $config);
        $this->queryBuilder = $this->connection->createQueryBuilder();
    }

    public function insertData($name, $address, $city, $postCode, $country)
    {
        $this->queryBuilder->insert('customers')
            ->values( ['CustomerName' => '?' , 'Address' => '?' , 'City' => '?' ,  'PostalCode' => '?' , 'Country' => '?' ])
            ->setParameters([ 0 => $name , 1 => $address , 2 => $city, 3 => $postCode , 4 => $country]);

        if($this->queryBuilder->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getData()
    {
        $data = array();

        $this->queryBuilder -> select ('CustomerName' , 'Address' , 'City' , 'PostalCode', 'Country')
            ->from ('customers') ;

        $queryData = $this->queryBuilder->execute();

         while ($row = $queryData->fetch()) {
                $data[] = $row ;
         }

         print_r($data);
    }

    public function getCustomerByName($customerName)
    {
        $data = array();

        $this->queryBuilder -> select ('CustomerName' , 'Address' , 'City' , 'PostalCode', 'Country')
            ->from ('customers')
            ->where('CustomerName = ?')
            ->setParameter(0, $customerName);

        $queryData = $this->queryBuilder->execute();

        while ($row = $queryData->fetch()) {
                $data[] = $row ;
         }

         print_r($data);
    }
}