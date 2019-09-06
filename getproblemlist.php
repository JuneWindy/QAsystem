<?php

//$getproblemList = $_POST['getproblemList'];
//$uid = $getproblemList['UserID'];

$uid=$_POST['UserID'];
$con=@new mysqli("123.206.68.192", "root", "");
//如果连接错误
if(mysqli_connect_errno()){
    echo "连接数据库失败：".mysqli_connect_error();
    $con=null;
    exit;
}
mysqli_select_db($con, "problem");
$sql = ("select `user`.username,question.title,question.qcontent,question.qtime,
       question.qID,question.ifsolved,question.iftop from question 
         join `user` on `user`.userID = question.quserID ");
$result = mysqli_query($con,$sql);
//echo mysqli_num_rows($result);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
//echo json_encode($data);

$sql1 = ("SELECT DISTINCT questionLike.qID FROM questionLike WHERE questionLike.userID = '$uid'");

$result1 = mysqli_query($con,$sql1);
//echo mysqli_num_rows($result);
if (!$result1) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
$data1 = array();
while ($row1 = mysqli_fetch_assoc($result1)) {
    $data1[] = $row1;
}

$arr = array();
$arr['data'] = $data;
$arr['data1'] = $data1;
echo json_encode($arr);
//echo json_encode($data1);


?>