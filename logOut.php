<?php

//$logOut = $_POST['logOut'];
$uid = $_POST['UserID'];
$con=@new mysqli("123.206.68.192", "root", "");
//如果连接错误
if(mysqli_connect_errno()){
    echo "连接数据库失败：".mysqli_connect_error();
    $con=null;
    exit;
}
mysqli_select_db($con, "problem");

$sql = ("update user set ifonline = 0 where userID = '$uid';");
$result = mysqli_query($con,$sql);

echo json_encode($result);
?>