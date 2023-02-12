<?php

$data = json_decode(file_get_contents('php://input'), true);
$productId = $data['basketId'];
$cookie_name = $productId;
setcookie($cookie_name , "", time() - 3600, "/");
header("Location: ../basket.php");
?>