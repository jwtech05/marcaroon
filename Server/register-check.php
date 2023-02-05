<?php
$servername = "localhost";
$username = "root";
$password = "pchris3528p!!";
$dbname = "opentutorials";

$mysqli = new mysqli($servername, $username, $password, $dbname);


var_dump($_POST);

$filtered = array(
  'id'=>mysqli_real_escape_string($mysqli, $_POST['aid']),
  'password'=>mysqli_real_escape_string($mysqli, $_POST['apassword']),
  'nickname'=>mysqli_real_escape_string($mysqli, $_POST['anickname']),
  'phone'=>mysqli_real_escape_string($mysqli, $_POST['aphone']),
  'email'=>mysqli_real_escape_string($mysqli, $_POST['aemail']),
  'birth'=>mysqli_real_escape_string($mysqli, $_POST['abirth']),
  'gender'=>mysqli_real_escape_string($mysqli, $_POST['agender']),
  'address'=>mysqli_real_escape_string($mysqli, $_POST['address']),
  'address2'=>mysqli_real_escape_string($mysqli, $_POST['address2'])
);


$passwordHash = password_hash($filtered['password'], PASSWORD_DEFAULT);

$author = 1;

settype($filtered['phone'],"integer");

//주소값 상세주소와 합침
$address = $filtered['address']." ".$filtered['address2'];
var_dump($address);

//성별 int 값으로 변환(남자는 1 여자는 2)
if($filtered['gender'] === "남"){
  $sex = 1;
}else{
  $sex = 2;
}

$sql = "
  INSERT INTO member (authorId, Id, password, username, phone, address, address2, birth, gender, email, enrollDate, lastUpdate)
  VALUES($author,  '{$filtered['id']}', '$passwordHash' ,'{$filtered['nickname']}', {$filtered['phone']}, '{$filtered['address']}', '{$filtered['address2']}' ,'{$filtered['birth']}', $sex, '{$filtered['email']}', now(), now())
";
$result = mysqli_query($mysqli, $sql);
if($result === false){
  echo '저장하는 과정에서 문제가 생겼습니다. 관리자에게 문의해주세요';
  error_log(mysqli_error($mysqli));
}else{
  echo "성공";
  header("Location: ../login.php");
}

$mysqli-> close();
?>
