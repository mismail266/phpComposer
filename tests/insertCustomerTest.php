<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;

class InsertCustomerTest extends TestCase{
    use TestCaseTrait;

    // only instantiate pdo once for test clean-up/fixture load
    static private $pdo = null;

    // only instantiate PHPUnit\DbUnit\Database\Connection once per test
    private $conn = null;

    final public function getConnection() {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new PDO( $GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'] );
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $GLOBALS['DB_DBNAME']);
        }

        return $this->conn;
    }

    public function getDataSet() {
        return $this->createFlatXmlDataSet('./tests/customer_fixture.xml');
    }

    public function testRowCount() {
        $this->assertSame(2, $this->getConnection()->getRowCount('customers'), "Pre-Condition");
    }

    public function testAddCustomer() {

        $printCustomerData = new \Console\App\DatabaseClasses\DatabaseClass();
        $printCustomerData->insertData("Antonio Moreno Taquería", "Mataderos 2312", "México D.F.", "12209", "Mexico");

        $queryTable = $this->getConnection()->createQueryTable(
            'customers', 'SELECT CustomerID, CustomerName, Address, City, PostalCode, Country FROM customers'
        );

        $expectedTable = $this->createFlatXmlDataSet("./tests/customer_expected.xml")
            ->getTable("customers");

        $this->assertTablesEqual($expectedTable, $queryTable);

    }
}