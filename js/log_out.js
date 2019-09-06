/**
 * Created by apple on 2018/12/26.
 */

    $(function(){
        var $m_btn = $('#modalBtn');
        var $modal = $('#myModal');

        $(document).ready(function(){
            if($.cookie('dm_userID')==null)
            {
                alert("未登录！");
                window.location.href="index.html";
            }
        });

        //var UserID=$.cookie('dm_userID');
        //var UserName=$.cookie('dm_userName');
        //var Pwd=$.cookie('dm_password');
        //获得基础信息
        window.UserID=$.cookie('dm_userID');
        window.UserName=$.cookie('dm_userName');
        window.Pwd=$.cookie('dm_password');
        $("#loginname").load($.cookie('dm_userName'));
        $("#showproblem").load(function(){
            $.ajax({
                url: "getproblemlist.php",
                async: true,
                type: 'post',
                data: {
                    UserID: $.cookie('dm_userID')
                },
                datatype:'json',
                success: function (data) {
                    data1 = JSON.parse(data);
                    console.log(data1["data"]);
                    alert(data1["data"]);
                    /*if (data1[""]== true) {
                     alert("post successed");
                     }
                     else {
                     alert("post failed");
                     }*/
                },
                error: function () {
                    alert("connection failed");
                }
            });
        });

        //获得头像图片
        if(fileExists("/img/"+UserID+".png"))
        {
            var str = "/img/" + UserID + ".png" + '?' + Math.random();
            $("#logo11").attr("src",str);
            $("#imgHeadPhoto1").attr("src",str);
            $("#imgHeadPhoto2").attr("src",str);
        }
        else
        {
            $("#logo11").attr("src","/img/default.jpg");
            $("#imgHeadPhoto1").attr("src","/img/default.jpg");
            $("#imgHeadPhoto2").attr("src","/img/default.jpg");
        }
        //上传图片
        $('#upload_userID').val(UserID);
        //$("#logo11").attr("src","/img/"+UserID+".png"+'?'+Math.random());

        $m_btn.on('click', function(){
            $modal.modal({backdrop: 'static'});
        });

        $modal.on('show.bs.modal', function(){
            var $this = $(this);
            var $modal_dialog = $this.find('.modal-dialog');
            $this.css('display', 'block');
            $modal_dialog.css({'margin-top': Math.max(0, ($(window).height() - $modal_dialog.height()) / 2) });
        });

        $("#btn-update-profile").click(function(){
            //alert("test");
            var oldPass=$("#oldPwd").val();
            var newPass=$("#newPwd").val();
            var conformPass=$("#confirmPwd").val();
            if(oldPass==Pwd)
            {
                if(newPass==conformPass)
                {
                    var xhr = null;
                    try {
                        xhr = new XMLHttpRequest();
                    } catch (e) {
                        xhr = new ActiveXObject('Microsoft.XMLHTTP');
                    }
                    xhr.open("POST", "changePwd.php", true);
                    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                    xhr.send("UserID="+UserID+"&NewPwd="+newPass);
                    xhr.onreadystatechange = function()
                    {
                        if (xhr.readyState == 4 && xhr.status == 200)
                        {
                            alert("update success!");
                            Pwd=newPass;
                            $("#oldPwd").val("");
                            $("#newPwd").val("");
                            $("#confirmPwd").val("");
                        }
                    }

                }
                else
                {
                    alert("conform error");
                }
            }
            else
            {
                alert("old Password wrong!");
            }
        });

        $('#imgHeadPhoto').click(function(){
            $('#logo_file').click();
        });

        $("#logo_file").change(function(){
            var file = this.files[0];
            if (window.FileReader) {
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onloadend = function (e) {
                    $("#imgHeadPhoto").attr("src",e.target.result);
                    $("#logo11").attr("src","/img/"+UserID+".png");
                };
            }
        });
        //上传文件存在的话，那么返回1
        function fileExists(url){
            var isExists;
            $.ajax({
                url:url,
                async:false,
                type:'HEAD',
                error:function(){
                    isExists=0;
                },
                success:function(){
                    isExists=1;
                }
            });
            if(isExists==1){
                return true;
            }
            else{
                return false;
            }
        }


        $("#btn-log-out1").click(function () {
            var xhr = null;
            try {
                xhr = new XMLHttpRequest();
            } catch (e) {
                xhr = new ActiveXObject('Microsoft.XMLHTTP');
            }
            xhr.open("POST", "logOut.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("UserID=" + UserID);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert("Log out!");
                    $.removeCookie('dm_userID', {path: '/'});
                    $.removeCookie('dm_isadmin', {path: '/'});
                    $.removeCookie('dm_userName', {path: '/'});
                    $.removeCookie('dm_password', {path: '/'});
                    window.location.href = "index.html";
                }
            }

        });
        $("#btn-log-out").click(function () {
            var xhr = null;
            try {
                xhr = new XMLHttpRequest();
            } catch (e) {
                xhr = new ActiveXObject('Microsoft.XMLHTTP');
            }
            xhr.open("POST", "logOut.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("UserID=" + UserID);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert("退出登录");
                    $.removeCookie('dm_userID', {path: '/'});
                    $.removeCookie('dm_isadmin', {path: '/'});
                    $.removeCookie('dm_userName', {path: '/'});
                    $.removeCookie('dm_password', {path: '/'});
                    window.location.href = "index.html";
                }
            }
        });

    });