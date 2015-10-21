<?php
require_once 'medoo.php';

$database = new medoo(array(
  'database_type' => 'pgsql',
  'database_name' => 'dellstore2',
  'server' => 'localhost',
  'username' => 'postgres',
  'password' => 'Jiqiang@1977',
  'charset' => 'utf8',
  'port' => 5432
));

echo '<pre>';
print_r($database->info());


$data1 = $database->select(
  // Table name.
  'cust_hist', 
  // Joins.
  array(
    '[><]customers' => 'customerid',
    '[><]products' => 'prod_id',
    '[><]orders' => 'orderid',
  ),
  // Columns. 
  array(
    'customers.firstname',
    'customers.lastname',
    'products.title',
    'orders.orderdate',
    'orders.totalamount',
  ),
  // Where conditions. 
  array(
    'ORDER' => 'orders.orderdate ASC',
    'LIMIT' => 100,
  )
);

print_r($data1);

$sql = '
  SELECT
    customers.firstname,
    customers.lastname,
    products.title,
    orders.orderdate,
    orders.totalamount
  FROM cust_hist
  INNER JOIN customers ON cust_hist.customerid = customers.customerid
  INNER JOIN products ON cust_hist.prod_id = products.prod_id
  INNER JOIN orders ON cust_hist.orderid = orders.orderid
  ORDER BY orders.orderdate ASC
  LIMIT 100
';

$data = $database->query($sql)->fetchAll();

print_r($data);