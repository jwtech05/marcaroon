<?php
$servername = "localhost";
$username = "root";
$password = "pchris3528p!!";
$dbname = "opentutorials";

$mysqli = new mysqli($servername, $username, $password, $dbname);
settype($_COOKIE['번호'], "integer");
$memberInfo = "
    SELECT *, CONCAT(address,' ',address2) as addresses 
    From member
    Where memberId = {$_COOKIE['번호']};
";

$Result = mysqli_query($mysqli, $memberInfo);

$row = mysqli_fetch_array($Result);


echo json_encode($row);