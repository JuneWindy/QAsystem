<?php
//参数：file是一张图片，userID是一个整数
$text=$_POST["userID"].'.png';
$userID=$_POST["userID"];
if($_FILES["file"]["error"])
{
    header("location:settings.html"); 
    //echo $_FILES["file"]["error"];
    return 0;
}
else
{
    //没有出错
    //加限制条件
    //判断上传文件类型为png或jpg且大小不超过1024000B
    //$last=explode('.',$_FILES["file"][""]);

    if(($_FILES["file"]["type"]=="image/png"||$_FILES["file"]["type"]=="image/jpeg")&&$_FILES["file"]["size"]<1024000)
    {
        //防止文件名重复
        $filename ="./img/".$text;
        //转码，把utf-8转成gb2312,返回转换后的字符串， 或者在失败时返回 FALSE。
        $filename =iconv("UTF-8","gb2312",$filename);
        //保存文件,   move_uploaded_file 将上传的文件移动到新位置
        move_uploaded_file($_FILES["file"]["tmp_name"],$filename);//将临时地址移动到指定地址



        //连接数据库更新头像的文件名
        $image_url="http://www.zdoubleleaves.cn/userImage/".$text;
        $con = mysqli_connect("123.206.68.192","root","","problem");
        mysqli_query($con,"UPDATE user SET image= '$image_url'WHERE userID='$userID'");
        mysqli_close($con);

        header("location:settings.html");
        return 1;
    }
    else
    {
        header("location:settings.html");
        echo"文件类型不对";
        return 0;
    }


}