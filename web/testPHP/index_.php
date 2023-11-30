<!doctype html>

<head>
    <!--<base href="http://www.runoob.com/images/" target="_blank">-->
    <!--<link rel="stylesheet" type="text/css" href="mystyle.css">-->

    <style type="text/css">
    body {
        background-color: #cbe9cf
    }

    p {
        color: blue
    }
    </style>
</head>

<body>

    <script>
    function myFunc() {
        x = document.getElementById("test");
        x.innerHTML = "Hello!";
        x.style.color = "#00aa00"
    }
    </script>
    <button type="button" onclick="myFunc()"> click </button>
    <h3 style="" title="hh" id="test">test</h3>
    <hr>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <a href="#3" style=""> ...</a>
    <p>1234</p>

    <form action="index.php" method="post">
        user: <input type="text" name="userName"><br>
        pwd: <input type="password" name="pass">

        <br>
        role: <input type="radio" name="role">
        <input type="radio" name="role">

        <br>
        <input type="submit" name="ok" value="ok">
    </form>

    <hr>
    <form>
        <label>Name:
            <input name="submitted-name" autocomplete="name">
        </label>
        <button>Save</button>
    </form>

    <!-- 以下表单使用 POST 请求发送数据到当前的 URL。 -->
    <form method="post">
        <label>Name:
            <input name="submitted-name" autocomplete="name">
        </label>
        <button>Save</button>
    </form>

    <!-- 表单使用 fieldset, legend, 和 label 标签 -->
    <form method="post">
        <fieldset>
            <legend>Title</legend>
            <label><input type="radio" name="radio"> Select me</label>
        </fieldset>
    </form>

    <!--solid实线，dashed虚线-->
    <fieldset style="width:300;height:150;border:1px dashed purple">
        <!--<fieldset>-->
        <legend
            style="width:100px;border:1px dashed #ff9966;background-color:#00ffff33;text-align:center;font-family:arial;font-weight:bold">
            1234
        </legend>

        <div style="text-align:center">
            <input type="color" value="color">
            <input type="color" value="color">
            <input type="color" value="color">
            <input type="color" value="color">
            <input type="color" value="color">
        </div>

    </fieldset>


</body>

</html>

<?php

$varFileName = 'DFImg';
if (isset($_FILES[$varFileName])) //判断有没有指定字段
{
    $folder = $_POST["folder"]; //文件夹名 upload
    $fileName = $_FILES[$varFileName]["name"]; //文件名 xxx.jpg
    $tmp = $_FILES[$varFileName]["tmp_name"]; //临时存储的文件名  C:\Windows\php251.tmp 临时生成的缓存文件
    $fil = $folder . '/' . $fileName; //文件路径 upload/001.png

    if (file_exists($folder)) //判断有没有这个文件夹 
    {
        // echo '--exist folder=';
        if (file_exists($fil)) //判断有没有这个文件 
        {
            echo '--exist file';
            DFLine();
            echo 'tmp ', $tmp;
            unlink($fil); //删除文件
            move_uploaded_file($tmp, $fil); 
        }
        else {
            echo '--not exit file=';
            DFLine();
            echo 'temp ', $tmp;
            DFLine();
            $re = move_uploaded_file($tmp, $fil);
            // echo 'ret ',$ret;
            echo 're ', $re;
            DFLine();

        }
    }
    else {
        echo "mkdir", $folder;
        mkdir($folder, 0777); 
        move_uploaded_file($tmp, $fil); 
    }
    DFLine();
    echo 'end ', $fil;
}
else {
    echo '<br><br>';
    DFT();
    phpinfo();
}

function DFLine()
{
    echo PHP_EOL;
}

function DFT()
{
    date_default_timezone_set('prc');
    $data = date('y-m-d h:i:s', time());
    echo ':) ', $data;
}

?>