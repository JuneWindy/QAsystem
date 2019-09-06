<?php

//$regist = $_POST['regist'];
//$uname =isset($_POST['UserName']) ? $_POST['UserName'] : NULL;
//$pass =isset($_POST['Password']) ? $_POST['Password'] : NULL;
$uname = $_POST['UserName'];
$pass = $_POST['Password'];
$url = "/img/default.jpg";

//$regist = $_POST['regist'];
//$uname = $regist['UserName'];
//$pass = $regist['Password'];
//$url = "/img/default.jpg";

$con=@new mysqli("123.206.68.192", "root", "");
//如果连接错误
if(mysqli_connect_errno()){
    echo "连接数据库失败：".mysqli_connect_error();
    $con=null;
    exit;
}

mysqli_select_db($con, "problem");
$sql2="SELECT max(userID)  FROM user ";
$result2 = mysqli_query($con,$sql2);
$data= mysqli_fetch_assoc($result2);
$count = $data['max(userID)'];
$count = $count + 1;
$sql = ("insert into user values('$count','$uname','$pass','$url',NULL,NULL,NULL,false,false);" );
$result = mysqli_query($con,$sql);
//$arr = array('res'=>$result);
//$arr = array('res'=>'true');
//echo json_encode($arr);
echo json_encode($result);
?>
