<?php
//mysql 접속
require('./mysql-connect.php');

$data = json_decode(file_get_contents('php://input'), true);


$memberId = $data['memberId'];
$productId = $data['productId'];
$productNum = $data['productNum'];

settype($memberId, "integer");
settype($productId, "integer");
settype($productNum, "integer");

$basketSelect = "
  Select * 
  FROM basket
  Where memberId = {$memberId} and productId = {$productId}
";

$basketSelectResult = mysqli_query($mysqli, $basketSelect);
if(mysqli_affected_rows($mysqli) == 0){
  $basketInsert = "
    INSERT INTO basket (memberId, productId, productNum)
    VALUES({$memberId},{$productId}, {$productNum})
  ";
}else{
  $row = mysqli_fetch_array($basketSelectResult);
  $newProductNum = $productNum + $row['productNum'];
  $basketInsert = "
    UPDATE basket
    SET 
      productNum = $newProductNum
    WHERE
      basketId = {$row['basketId']};
  ";
}



$result = mysqli_query($mysqli, $basketInsert);
if($result === false){
  echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
  error_log(mysqli_error($mysqli));
}else{
  echo "성공";
}

$mysqli-> close();
?>

