<?php
$uid=$_POST['UserID'];
$con=@new mysqli("123.206.68.192", "root", "");
//如果连接错误
if(mysqli_connect_errno()){
    echo "连接数据库失败：".mysqli_connect_error();
    $con=null;
    exit;
}
mysqli_select_db($con, "problem");

$sql = ("
select DISTINCT `user`.username,question.title,question.qcontent,question.qtime,
                question.qID,question.ifsolved,question.iftop from question join `user` 
                  on `user`.userID = question.quserID join questionLike  
        WHERE `user`.userID =  '$uid' order by question.iftop DESC,question.qtime ASC;");
$result = mysqli_query($con,$sql);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}
//echo json_encode($data);//这个是本人发出的所有问题总和
$sql1 = ("
select DISTINCT question.qID from question join `user` on `user`.userID = question.quserID 
  join questionLike  WHERE question.qID = questionLike.qID AND`user`.userID =  1 
order by question.iftop DESC,question.qtime ASC;
");
$result1 = mysqli_query($con,$sql1);

$data1 = array();
while ($row1 = mysqli_fetch_assoc($result1)) {
    $data1[] = $row1;
}

$arr = array();
$arr['data'] = $data;
$arr['data1'] = $data1;
echo json_encode($arr);
//echo json_encode($data1);//这个是like的qID
?>