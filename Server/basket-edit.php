<?php
$servername = "localhost";
$username = "root";
$password = "pchris3528p!!";
$dbname = "opentutorials";

$mysqli = new mysqli($servername, $username, $password, $dbname);


$data = json_decode(file_get_contents('php://input'), true);

$productId = $data['productId'];
$productNum = $data['productNum'];

settype($productNum, "integer");
settype($productId, "integer");

$sql = "
    UPDATE basket
    SET productNum = $productNum
    WHERE productId = $productId and memberId = 1
";
$result = mysqli_query($mysqli, $sql);
if($result === false){
    echo '품목수정에 실패하셨습니다.';
    error_log(mysqli_error($conn));
} else{
    echo '품목이 성공적으로 수정 되었습니다.';
}
$mysqli->close();
?>