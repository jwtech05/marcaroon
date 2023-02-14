<?php
$servername = "localhost";
$username = "root";
$password = "pchris3528p!!";
$dbname = "opentutorials";

$mysqli = new mysqli($servername, $username, $password, $dbname);


$data = json_decode(file_get_contents('php://input'), true);

$filtered = array(
    'username'=>mysqli_real_escape_string($mysqli, $data['username']),
    'phone'=>mysqli_real_escape_string($mysqli, $data['phone']),
    'email'=>mysqli_real_escape_string($mysqli, $data['email']),
    'address'=>mysqli_real_escape_string($mysqli, $data['address']),
    'address2'=>mysqli_real_escape_string($mysqli, $data['address2'])
  );



$sql = "
    UPDATE member
    SET 
    username = '{$filtered['username']}',
    phone = '{$filtered['phone']}',
    email = '{$filtered['email']}',
    address = '{$filtered['address']}',
    address2 ='{$filtered['address2']}',
    lastUpdate = now()
    WHERE memberId = 13
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