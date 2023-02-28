<?php
//mysql 접속
require('./mysql-connect.php');


settype($_COOKIE['번호'], "integer");
$memberInfo = "
    SELECT *, CONCAT(address,' ',address2) as addresses 
    From member
    Where memberId = {$_COOKIE['번호']};
";

$Result = mysqli_query($mysqli, $memberInfo);

$row = mysqli_fetch_array($Result);


echo json_encode($row);