<?php
//mysql 접속
require('./mysql-connect.php');

$data = json_decode(file_get_contents('php://input'), true);

if($data['index'] == 1){
    $searchInfo = "
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
        WHERE member.username LIKE'{$data['word']}%';
    ";
}else if($data['index'] == 2){
    settype($data['word'], "integer");
    $searchInfo = "
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
        WHERE member.memberId = {$data['word']};
    ";
}else if($data['index'] == 3){
    if($data['word'] == '주문완료'){
        $data['word'] = 0;
    }else if($data['word'] == '배송중'){
        $data['word'] = 1;
    }else if($data['word'] == '배송완료'){
        $data['word'] = 2;
    }else{
        $data['word'] = 100;
    }

    $searchInfo = "
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
        WHERE dstatus = {$data['word']};
    ";
}



$bResult = mysqli_query($mysqli, $searchInfo);

$member = mysqli_fetch_array($bResult);

$new = [];

while($row = mysqli_fetch_array($bResult)){
    $new[] = $row;
}

echo json_encode($new);