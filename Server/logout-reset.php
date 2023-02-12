<?php
session_start();
session_destroy();
setcookie('가입자',"", time() - 3600, "/");
header("Location: ../index.php");
echo "<script> alert('로그아웃 성공!'); </script>";
?>