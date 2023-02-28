<?php
//mysql 접속
require('./mysql-connect.php');

$data = json_decode(file_get_contents('php://input'), true);

$basketId = $data['basketId'];
settype($basketId, "integer");

$sql = "
    DELETE FROM basket WHERE basketId='{$basketId}'
";

$result = mysqli_query($mysqli, $sql);
if($result === false){
    echo '품목삭제에 실패하셨습니다.';
    error_log(mysqli_error($conn));
} else{
    echo '품목이 성공적으로 삭제 되었습니다.';
    header("Location: ../basket.php");
}

?>