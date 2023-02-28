<?php
//mysql 접속
require('./mysql-connect.php');

$id = $_GET['id'];


$sql = "
    DELETE FROM product WHERE productId='{$id}'
";

$result = mysqli_query($mysqli, $sql);
if($result === false){
    echo '품목삭제에 실패하셨습니다.';
    error_log(mysqli_error($conn));
} else{
    echo '품목이 성공적으로 삭제 되었습니다.';
    header("Location: ../product.php");
}

?>