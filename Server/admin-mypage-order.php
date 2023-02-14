<?php
$servername = "localhost";
$username = "root";
$password = "pchris3528p!!";
$dbname = "opentutorials";

$mysqli = new mysqli($servername, $username, $password, $dbname);

$basketInfo = "
SELECT member.memberId, orderId,username ,date_format(date, '%y/%m/%d') as date, pName ,saleprice, changedate, productNum,
CASE dstatus 
WHEN 0 THEN '주문완료'
WHEN 1 THEN '배송중'
WHEN 2 THEN '배송완료'
ELSE '주문완료'
END AS delivery
FROM opentutorials.order
JOIN product
ON product.productId = opentutorials.order.productId
JOIN member
ON member.memberId = opentutorials.order.memberId
";

$bResult = mysqli_query($mysqli, $basketInfo);

$member = mysqli_fetch_array($bResult);

while($row = mysqli_fetch_array($bResult)){
    $data[] = $row;
}

echo json_encode($data);