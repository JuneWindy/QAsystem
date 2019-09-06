/**
 * Created by apple on 2018/12/27.
 */
    $("#btnLoad").click(function(){
        var t = document.getElementById('title').innerHTML;
        var c = document.getElementById(document.getElementById('editor').innerHTML);
        if(t == "")
        {
            alert('Please enter the title!');
        }
        else if(c == null)
        {
            alert('Please enter the content!');
        }
        else {
            $.ajax(
                {
                    url: "postProblem.php",
                    async: true,
                    type: 'post',
                    data: {
                        title: document.getElementById('title').innerHTML,
                        content: escapeStringHTML(document.getElementById('editor').innerHTML),
                        UserID: $.cookie('dm_userID')
                    },
                    success: function (data) {
                        if (data == "true") {
                            alert("post successed");
                        }
                        else {
                            alert("post failed");
                        }
                    },
                    error: function () {
                        alert("connection failed");
                    }
                }
            );
        }
    });

//把HTML格式的字符串转义成实体格式字符串
function escapeHTMLString(str) {
    str = str.replace(/</g,'&lt;');
    str = str.replace(/>/g,'&gt;');
    return str;
}

//把实体格式字符串转义成HTML格式的字符串
function escapeStringHTML(str) {
    str = str.replace(/&lt;/g,'<');
    str = str.replace(/&gt;/g,'>');
    return str;
}