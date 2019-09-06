<?php


$showComment = $_POST['showComment'];
$qid = '2';//$showComment['qID'];
$con=@new mysqli("123.206.68.192", "root", "");
//如果连接错误
if(mysqli_connect_errno()){
    echo "连接数据库失败：".mysqli_connect_error();
    $con=null;
    exit;
}
mysqli_select_db($con, "problem");
$sql = ("select user.username,comment.ccontent,comment.ctime from comment,user where user.userID = comment.userID and comment.qID = '$qid'
order by comment.ctime DESC;" );
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
echo json_encode($data);

?>