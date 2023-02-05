<?php
$servername = "localhost";
$username = "root";
$password = "pchris3528p!!";
$dbname = "opentutorials";

$mysqli = new mysqli($servername, $username, $password, $dbname);


$data = json_decode($_POST, true);

$memberId = $data['memberId'];
$productId = $data['productId'];
$productNum = $data['productNum'];



$sql = "
  INSERT INTO basket (memberId, productId, productNum)
  VALUES({'$memberId'},{'$productId'}, {'$productNum'})
";

$result = mysqli_query($mysqli, $sql);
if($result === false){
  echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
  error_log(mysqli_error($mysqli));
}else{
  echo "성공";
  echo '<script type="text/javascript">alert("This is an alert message");</script>';
}

$mysqli-> close();
?>

