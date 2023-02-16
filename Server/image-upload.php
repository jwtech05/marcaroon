<?php

if ($_FILES["fileToUpload"]["error"] == UPLOAD_ERR_OK) {
  $fileName = $_FILES["fileToUpload"]["name"];
  $tempName = $_FILES["fileToUpload"]["tmp_name"];
  move_uploaded_file($tempName, "D:\httpd-2.4.54-win64-VS17\Apache24\htdocs\marcaroon\product\macaroon/$fileName");
  echo "Upload successful";
} else {
  echo "Upload failed";
}

$cookie_name = '이름';
$cookie_value = $fileName;
setcookie($cookie_name, $cookie_value, time() + 8000, "/");

?>