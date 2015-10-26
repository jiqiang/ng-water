<?php

/**
 * Dell store class.
 */
class DellStore
{

    private $_dbConn;

    public function __construct()
    {

    }

    /**
     * Find customer order history.
     *
     * @return array
     */
    public function findCustomerOrderHistory()
    {
        return $this->connection->select(
            'cust_hist',
            array(
                '[><]customers' => 'customerid',
                '[><]products' => 'prod_id',
                '[><]orders' => 'orderid',
            ),
            array(
                'customers.firstname',
                'customers.lastname',
                'products.title',
                'orders.orderdate',
                'orders.totalamount',
            ),
            array(
                'ORDER' => 'orders.orderdate ASC',
                'LIMIT' => 100,
            )
        );
    }

    /**
     * Get database connection.
     *
     * @param  resource $connection Medoo class instance.
     *
     * @return resource Medoo class instance.
     */
    public function getDatabaseConnection($connection)
    {
        $this->_dbConn = $connection;
    }
}
