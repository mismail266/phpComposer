<?php
require 'vendor/autoload.php';
use Doctrine\DBAL\Configuration;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL\DriverManager;

class Database
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

   public function getData() 
    {
       $this->queryBuilder -> select ('CustomerName' , 'Address' , 'City' , 'PostalCode', 'Country')
        ->from ('customers') ;
       $sql = "SELECT * FROM customers";
       $data = $this->queryBuilder->execute();

       echo "<table >";
       while ($row = $data->fetch()) {
        echo "<tr style = 'border: 1px solid #dddddd;'>";
        echo  "<td style = 'border: 1px solid #dddddd;' >" , $row['CustomerName'] , "</td>";
		echo  "<td style = 'border: 1px solid #dddddd;' >" , $row["Address"] , "</td>";
        echo  "<td style = 'border: 1px solid #dddddd;' >" , $row["City"] , "</td>";
        echo  "<td style = 'border: 1px solid #dddddd;' >" , $row["PostalCode"] , "</td>";
        echo  "<td style = 'border: 1px solid #dddddd;' >" , $row["Country"] , "</td>";
        echo "</tr>";
        }
        echo "</table>";
    }

    public function insertData($name,$address,$city,$postCode,$country)
    {

    $this->queryBuilder->insert('customers')
    ->values( ['CustomerName' => '?' , 'Address' => '?' , 'City' => '?' ,  'PostalCode' => '?' , 'Country' => '?' ])   
   ->setParameters([ 0 => $name , 1 => $address , 2 => $city, 3 => $postCode , 4 => $country]);
    $sql =  $this->queryBuilder->execute();
    echo "Data Inserted" ;
    }
}
$db = new Database();
$db -> getData();
$db -> insertData("Ismail","4 mandrin ct", "Perth", "39409", "Ausrlia");
?>