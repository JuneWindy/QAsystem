<?php


//$postProblem = $_POST['postProblem'];
$title = $_POST['title'];
$qcontent = $_POST['content'];
$quserID =$_POST['UserID'];
//$time = $_POST['time'];//2018-12-17 12:54:04这种格式的比较好，其他的没有测试
$time =date('Y-m-d H:i:s');
$con=@new mysqli("123.206.68.192", "root", "");
//如果连接错误
if(mysqli_connect_errno()){
    echo "连接数据库失败：".mysqli_connect_error();
    $con=null;
    exit;
}

mysqli_select_db($con, "problem");

$sql2="SELECT max(qID)  FROM question";
$result2 = mysqli_query($con,$sql2);

$data= mysqli_fetch_assoc($result2);
$count = $data['max(qID)'];
$count = $count + 1;

$sql = ("insert into question values('$count','$title','$qcontent','$quserID',0,'$time',NULL,NULL,NULL,0); ");
$result = mysqli_query($con,$sql);
//$arr = array('res'=>$result);
//$arr = array('res'=>'true');
//echo json_encode($arr);

echo json_encode($result);
?>
