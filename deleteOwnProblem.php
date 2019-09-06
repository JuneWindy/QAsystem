<?php
$deleteOwnProblem = $_POST['deleteOwnProblem'];
$qid = $deleteOwnProblem['qID'];
$con=@new mysqli("123.206.68.192", "root", "");
//如果连接错误
if(mysqli_connect_errno()){
    echo "连接数据库失败：".mysqli_connect_error();
    $con=null;
    exit;
}
mysqli_select_db($con, "problem");

$sql = ("delete from question where qID = '$qid';");
$result = mysqli_query($con,$sql);

$sql1 = ("
delete from questionLike where qID = '$qid';");
$result1 = mysqli_query($con,$sql);

$sql2 = ("
delete from comment where qID = '$qid';");
$result2 = mysqli_query($con,$sql2);

echo json_encode($result);
echo json_encode($result1);
echo json_encode($result2);
?>
