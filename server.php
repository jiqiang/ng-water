<?php
$nuo = array(
    "glen",
    38,
    array("a" => "b"),
);
header('Content-Type: application/json');
echo json_encode($nuo);
