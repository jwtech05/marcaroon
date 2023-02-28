<?php
//mysql 접속
require('./mysql-connect.php');

$id = $_POST['Id'];
$editName = $_POST['editName'];
$editPrice = $_POST['editPrice'];
$editDescript = $_POST['editDescript'];

settype($editPrice, "integer");

$sql = "
    UPDATE product
    SET 
        pName = '{$editName}',
        price = '{$editPrice}',
        description = '{$editDescript}'
    WHERE
        productId = '{$id}'
";

$result = mysqli_query($mysqli, $sql);
if($result === false){
    echo '품목수정에 실패하셨습니다.';
    error_log(mysqli_error($conn));
} else{
    echo '품목이 성공적으로 수정 되었습니다.';
    header("Location: ../product.php");
}
?>