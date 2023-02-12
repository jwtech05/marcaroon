<?php
$servername = "localhost";
$username = "root";
$password = "pchris3528p!!";
$dbname = "opentutorials";

$mysqli = new mysqli($servername, $username, $password, $dbname);

$data = json_decode(file_get_contents('php://input'), true);

$receiver = $data["receiver"];
$phoneNum = $data["phoneNum"];
$address = $data["address"]." ".$data["address2"];
$comment = $data["comment"];
$basketId = json_decode($data["items"], true);
$prices = json_decode($data["prices"], true);

$basketArray=[];

foreach ($basketId as $value){

    settype($value, "integer");
    array_push($basketArray, $value);
}

$fixedBasketArray = implode(",", $basketArray);
//해당 장바구니 불러오는 부분;
$basketSelect = "
    SELECT productId, productNum, memberId 
    FROM basket 
    WHERE basketId in ({$fixedBasketArray})
";

$result = mysqli_query($mysqli, $basketSelect);
$i = 0;
while($row = mysqli_fetch_array($result)){
    //주문 추가 부분
   $orderAdd = "
        INSERT opentutorials.order (memberId, productId, date, receiver, address, contactnum, productnum, saleprice, message)
        VALUES ( '{$row['memberId']}','{$row['productId']}', now(), '$receiver', '$address', '$phoneNum', '{$row['productNum']}', '$prices[$i]', '$comment')
   ";
   $orderAddResult = mysqli_query($mysqli, $orderAdd);
    //주문 완료된 장바구니 삭제 부분
   $basketDelete = "
        DELETE FROM basket WHERE basketId='{$basketArray[$i]}'
    ";
    echo $basketArray[$i];
    $basketDeleteResult = mysqli_query($mysqli, $basketDelete);
   if($orderAddResult === false){
    echo '주문목록 추가 실패';
    error_log(mysqli_error($conn));
    }
    $i++;
}
header("Location: ../test.php")

?>