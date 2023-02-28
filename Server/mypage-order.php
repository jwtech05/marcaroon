<?php
//mysql 접속
require('./mysql-connect.php');

settype($_COOKIE['번호'], "integer");

$basketInfo = "
    SELECT memberId, date_format(date, '%y/%m/%d') as date, pName, picture ,saleprice, IF(dstatus=1, '배송중', '주문완료') as dstatus
    FROM opentutorials.order
    JOIN product
    ON product.productId = opentutorials.order.productId
    WHERE memberId = {$_COOKIE['번호']};
";

$bResult = mysqli_query($mysqli, $basketInfo);

$member = mysqli_fetch_array($bResult);

$new = [];

while($row = mysqli_fetch_array($bResult)){
    $new[] = $row;
}

echo json_encode($new);