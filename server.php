<?php
sleep(3);
$data = array(
    'name' => 'Glenn Ji',
    'age' => 38,
    'timestamp' => time(),
);
header('Content-Type: application/json');
echo json_encode($data);
