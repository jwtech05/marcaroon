<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "pchris3528p!!";
$dbname = "opentutorials";

$mysqli = new mysqli($servername, $username, $password, $dbname);


$filtered = array(
    'name'=>mysqli_real_escape_string($mysqli, $_POST['userId']),
    'password'=>mysqli_real_escape_string($mysqli, $_POST['userPassword']),
  );

$passwordHash = password_hash($filtered['password'], PASSWORD_DEFAULT);

$sql = "
    SELECT * FROM member where Id = '{$filtered['name']}'
";
$result = mysqli_query($mysqli, $sql);
$row = mysqli_fetch_array($result);

$sqlPassword = $row['password'];
//해당하는 아이디 칼럼의 비밀번호와 POST로 전송받은 비밀번호 비교

if(password_verify($filtered['password'], $sqlPassword)){


    $_SESSION["memberId"] = $row['memberId'];
    $cookie_name = '가입자';
    $cookie_value = $row['username'];
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    mysqli_close($mysqli);
    echo " <script>
                location.href = '../index.php';
           </script>";
    echo"<script>
            alert('로그인에 성공하셨습니다.');
        </script>";
}else{
    echo"<script>alert('비밀번호가 아이디와 일치하지 않습니다.');</script>";
    echo "비밀번호가 아이디와 일치하지 않습니다.";
    
}
?>