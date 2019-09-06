<?php
//$changePwd = $_POST['changePwd'];
$uid = $_POST['UserID'];
$newpass = $_POST['NewPwd'];
$con=@new mysqli("123.206.68.192", "root", "");
//如果连接错误
if(mysqli_connect_errno()){
    echo "连接数据库失败：".mysqli_connect_error();
    $con=null;
    exit;
}
mysqli_select_db($con, "problem");
$sql1=("update user set password = '$newpass' where userID = '$uid';");
mysqli_query($con,$sql1);
$sql = ("
update user set ifonline = 0 where userID = '$uid' and password = '$newpass';  ");
$result = mysqli_query($con,$sql);

echo json_encode($result);
?>
