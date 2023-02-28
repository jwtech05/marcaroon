<?php
//mysql 접속
require('./mysql-connect.php');

$basketInfo = "
SELECT * , date_format(enrollDate, '%y/%m/%d') as enrollDate, date_format(lastUpdate, '%y/%m/%d') as lastUpdate
,right(birth, 2) as birth,
CASE signstatus 
WHEN 1 THEN '휴먼'
WHEN 2 THEN '탈퇴'
ELSE '활동'
END AS signstatus
from member;
";

$bResult = mysqli_query($mysqli, $basketInfo);

$member = mysqli_fetch_array($bResult);

while($row = mysqli_fetch_array($bResult)){
    $data[] = $row;
}

echo json_encode($data);