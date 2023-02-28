<?php
//mysql 접속
require('./mysql-connect.php');

$data = json_decode(file_get_contents('php://input'), true);

var_dump($data);

settype($data['dstatus'], "integer");

$sql = "
    UPDATE opentutorials.order
    SET 
        dstatus = '{$data['dstatus']}'
    WHERE
        orderId = '{$data['orderNum']}'
";

$result = mysqli_query($mysqli, $sql);
if($result === false){
    echo '품목수정에 실패하셨습니다.';
    error_log(mysqli_error($conn));
} else{
    echo '품목이 성공적으로 수정 되었습니다.';
}
?>