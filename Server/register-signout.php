<?php
$servername = "localhost";
$username = "root";
$password = "pchris3528p!!";
$dbname = "opentutorials";

$mysqli = new mysqli($servername, $username, $password, $dbname);

$data = json_decode(file_get_contents('php://input'), true);


settype($_COOKIE['번호'], "integer");

$sql = "
    UPDATE member
    SET 
    Id = '탈퇴한회원',
    username = '탈퇴한회원',
    lastUpdate = now(),
    signstatus = '탈퇴'
    WHERE memberId = {$_COOKIE['번호']};
";
$result = mysqli_query($mysqli, $sql);
if($result === false){
    echo '회원정보 수정에 실패하셨습니다.';
    error_log(mysqli_error($conn));
} else{
    session_start();
    session_destroy();
    setcookie('가입자',"", time() - 3600, "/");
}
$mysqli->close();
?>