<?php
$qid=$_POST['qID'];
$content=$_POST['content'];
$time=$_POST['time'];
$uid=$_POST['UserID'];
//$comment = $_POST['comment'];
//$qid = $comment['qID'];
//$content = $comment['content'];
//$time = $comment['time'];//2018-12-17
//$uid = $comment['UserID'];
$con=@new mysqli("123.206.68.192", "root", "");
//如果连接错误
if(mysqli_connect_errno()){
    echo "连接数据库失败：".mysqli_connect_error();
    $con=null;
    exit;
}
mysqli_select_db($con, "problem");

$sql2="SELECT max(cID)  FROM comment";
$result2 = mysqli_query($con,$sql2);
$data= mysqli_fetch_assoc($result2);
$count = $data['max(cID)'];
$count = $count + 1;

$sql = ("insert into comment values('$count','$time','$uid','$content','$qid');
");
$result = mysqli_query($con,$sql);

$sql1 = ("
update question set ifsolved= 1 where qID='$qid';
");
$result1 = mysqli_query($con,$sql1);

$arr = array();
$arr['result'] = $result;
$arr['result1'] = $result1;
echo json_encode($arr);
//echo json_encode($result);
//echo json_encode($result1);
?>
