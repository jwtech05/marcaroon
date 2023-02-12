<?php

$data = json_decode(file_get_contents('php://input'), true);

$productId = $data['productId'];
$productNum = $data['productNum'];


$cookie_name = $productId;
$cookie_value = $productNum;


setcookie($cookie_name , $cookie_value , time() + 3600, "/");

?>