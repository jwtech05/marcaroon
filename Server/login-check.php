<?php
session_start();
//mysql 접속
require('./mysql-connect.php');


$filtered = array(
    'name'=>mysqli_real_escape_string($mysqli, $_POST['userId']),
    'password'=>mysqli_real_escape_string($mysqli, $_POST['userPassword']),
  );

//전송받은 비밀번호 해쉬화
$passwordHash = password_hash($filtered['password'], PASSWORD_DEFAULT);

$sql = "
    SELECT * FROM member where Id = '{$filtered['name']}'
";
$result = mysqli_query($mysqli, $sql);

$row = mysqli_fetch_array($result);

$sqlPassword = $row['password'];

//해당하는 아이디 칼럼의 비밀번호와 POST로 전송받은 비밀번호 비교
if(password_verify($filtered['password'], $sqlPassword)){
    if($row['authorId'] == 2){
        $_SESSION["authorId"] = 2;
    }
    //로그인 성공시 특정쿠키와 세션 지정
    $_SESSION["memberId"] = $row['memberId'];
    $cookie_name = '가입자';
    $cookie_value = $row['username'];
    setcookie($cookie_name, $cookie_value, time() + 3600, "/");
    $cookie_name = '번호';
    $cookie_value = $row['memberId'];
    setcookie($cookie_name, $cookie_value, time() + 3600, "/");
    mysqli_close($mysqli);
    echo " <script>
                location.href = '../index.php';
           </script>";
    echo"<script>
            alert('로그인에 성공하셨습니다.');
        </script>";
}else{
    echo"<script>alert('비밀번호가 아이디와 일치하지 않습니다.');</script>";
    echo " <script>
                location.href = '../login.php';
           </script>";
}
?>