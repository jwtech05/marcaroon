<?php
$servername = "localhost";
$username = "root";
$password = "pchris3528p!!";
$dbname = "opentutorials";

$mysqli = new mysqli($servername, $username, $password, $dbname);


$picture = $_COOKIE['이름'];
$addName = $_POST["addName"];
$addPrice = $_POST["addPrice"];
$addNotice = $_POST["addNotice"];
$addDescript = $_POST["addDescript"];

settype($addPrice, "integer");

$productadd = "
INSERT product (categoryId, pName, price ,picture, description, stock, saleNum, lastupdate)
VALUES (1, '{$addName}',{$addPrice} ,'{$picture}','{$addDescript}',0,0,now())
";

$result = mysqli_query($mysqli, $productadd);

setcookie('이름',"", time() - 8000, "/");

header("Location: ../index.php");

?>