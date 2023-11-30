<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy">
    <link rel="shortcut icon" href="/res/css/yw1.ico" type="image/x-icon">
    <title>乄</title>

    <style>
        /* body {
        margin: 0;
        font-family: Helvetica, sans-serif;
        overflow: hidden;
    }  */


        .df {
            position: sticky;
            top: 0px;
        }

        #foot {
            position: absolute;
            /* position:sticky; */
            /* position:rerelative; */
            bottom: 10px;
            text-align: center;
            font-size: 10px;
            width: 100%;
            color: #808080;
        }
    </style>

</head>

<body>

    <img src="res/img/yw.png"><br>
    <button onclick="printT()">help</button><br><br>


    <script>
        function printT() {
            alert("支持多文件上传 (1 选择文件  2 upload");
        }

        function CheckFile(target, id) {
            var fileSize = 0;
            var filetypes = [".jpg", ".png", ".rar", ".txt", ".zip", ".doc", ".ppt", ".xls", ".pdf", ".docx", ".xlsx"];
            var filepath = target.value;
            var filemaxsize = 1024 * 1024;//1000M
            // if (filepath) {
            //     var isnext = false;
            //     var fileend = filepath.substring(filepath.indexOf("."));
            //     if (filetypes && filetypes.length > 0) {
            //         for (var i = 0; i < filetypes.length; i++) {
            //             if (filetypes[i] == fileend) {
            //                 isnext = true;
            //                 break;
            //             }
            //         }
            //     }
            //     if (!isnext) {
            //         alert("不接受此文件类型！");
            //         target.value = "";
            //         return false;
            //     }
            // } else {
            //     return false;
            // }
            // if (!target.files) {
            //     var filePath = target.value;
            //     var fileSystem = new ActiveXObject("Scripting.FileSystemObject");
            //     if (!fileSystem.FileExists(filePath)) {
            //         alert("附件不存在，请重新输入！");
            //         return false;
            //     }
            //     var file = fileSystem.GetFile(filePath);
            //     fileSize = file.Size;
            // } else {
            //     fileSize = target.files[0].size;
            // }

            var objRes = document.getElementById("fileRes");

            for (let i = 0; i < target.files.length; i++) {
                fileSize += target.files[i].size;
            }

            var size = fileSize / 1024;
            if (size > filemaxsize) {

                objRes.textContent = "附件大小不能大于" + filemaxsize / 1024 + "M！";
                objRes.style.color = "#ff8000";
                // alert("附件大小不能大于" + filemaxsize / 1024 + "M！");
                target.value = "";
                return false;
            }
            if (size <= 0) {
                objRes.textContent = "附件大小不能为0M！";
                objRes.style.color = "#ff8000";
                // alert("附件大小不能为0M！");
                target.value = "";
                return false;
            }

            var objRes = document.getElementById("fileRes");
            objRes.textContent = "Verification Passed";
            objRes.style.color = "#60cc80";
        }




    </script>




    <form action="" method="post" enctype="multipart/form-data">
        select: <input type="file" id="file" name="DFFile[]" multiple="true" onchange="CheckFile(this)">
        <input type="submit" value="upload"> &nbsp <font size=1 id="fileRes"></font>

        <!-- select: <input type="file"  name="DFFile[]" multiple >
        <input type="submit" value="upload"> -->
    </form>




    <script>

    </script>



    <?php
    $speed = 6;


    echo '<br/><marquee class="df"  scrollamount=' . $speed . ' behavior="">  <a href="/res/darkfeast" style="color:#66ccff;text-decoration:none">Darkfeast</a></marquee><br>';

    ?>

    <div>
        <br />
        <br />
        <br />
        <br />

        <a href="/res/download" style="color:#6600ff;text-decoration:none">[download]</a> <br><br>
        <a href="/res/upload" style="color:#6600ff;text-decoration:none">[upload]</a>
        <br><br><br><br><br><br><br><br>

    </div>


    <div id="audio">
        <audio id="myAudio" style="width:180px;height:30px" preload="auto" controls="controls" autoplay="autoplay" loop="true">
            <source src="res/audio/bg1.mp3" type="audio/mp3">
            </source>
        </audio>
    </div>


    <div id='foot'>

        <?php
        $t = date('y-m-d H:i:s', getlastmod() + 8 * 3600);
        echo '<font> update ' . $t . '</font>';

        ?>
    </div>


</body>

</html>


<?php

// strip_tags() 函数删除字符串中的 HTML、XML 以及 PHP 的标签
// is_uploaded_file() 函数判断指定的文件是否是通过 HTTP POST 上传的
// self 可以访问本类中的静态属性和静态方法，可以访问父类中的静态属性和静态方法。用 self 时，可以不用实例化。
// 静态方法和属性又被称为类方法和类属性，因此不能在对象中使用伪变量 $this 可使用 self

// $t = date("y-m-d H:i:s",time()+8*3600);
// echo $t;
// DFLine();
// $tz= date_default_timezone_get();
// echo $tz;


// PrintDict($_POST);
// DFLine();
// PrintDict($_SERVER);

// echo 'pos '. var_dump($p); //pos会显示在后面 奇怪


// exec("mkdir test123",$out);
// print_r($out);

IPAccess();


if ($_SERVER["REQUEST_METHOD"] != "POST")
    return;


if (IPFilter()) {
    echo '<p style="text-align:center"><font center size=6 color=#ff0000>你的上传权限被加量兄吃了 +_+</font></p>';
    return;
}




Listen();

function IPAccess()
{
    // 单引号会把转移当成普通字符  要用双引号

    $file = fopen("access/accessIp.txt", "a+");
    $t = date("y-m-d H:i:s", time() + 8 * 3600);
    $content = '[' . $t . ']:' . "\t" . $_SERVER["REMOTE_ADDR"] . "\n";
    fwrite($file, $content);
    fclose($file);
}

function IPUploadRecord(string $record)
{
    $file = fopen("access/logUploadRecord.txt", "a+");
    $t = date("y-m-d H:i:s", time() + 8 * 3600);
    $content = '[' . $t . ']:' . "\t" . $_SERVER["REMOTE_ADDR"] . "\tupload\t" . $record . "\n";
    fwrite($file, $content);
    fclose($file);
}



function IPFilter(Type $var = null)
{

    $ipFile = fopen("access/deniedIp.txt", 'a+'); //a+方式打开 如果不存在则创建

    $resFilter = -1;
    while (!feof($ipFile)) {
        $ipStr = fgets($ipFile);

        $ipRes = str_contains($ipStr, $_SERVER["REMOTE_ADDR"]);
        if ($ipRes) {
            $resFilter = 1;
            break;
        }
    }

    if ($resFilter > 0) {
        return true;
    }
    return false;
}

function Listen()
{
    $varFileName = 'DFFile';


    if ($_SERVER["REQUEST_METHOD"] != "POST")
        return;

    if ($_FILES[$varFileName]['name'][0] == '')
        return;


    $t = date("y-m-d H:i:s", time() + 8 * 3600);
    echo "<font size=1 color=#0080dd>upload time: " . $t . "</font>";

    // return;
    // PrintDict($_FILES);
    // echo $_FILES[$varFileName]['size'][0];
    if ($_FILES[$varFileName]['size'][0] > 1024 * 1024 * 1024) {
        echo 'file size out of 1G...';
        return;
    }

    if (isset($_FILES[$varFileName])) {
        // $folder = $_POST["folder"];
        $folder = 'res/upload';
        $fileName = $_FILES[$varFileName]["name"];

        if (file_exists($folder)) {

            for ($i = 0; $i < count($fileName); $i++) {

                $tmp = $_FILES[$varFileName]["tmp_name"][$i];
                $fil = $folder . '/' . $fileName[$i];

                // if (strpos($fil, '.') === false) {
                //     //如果不包含扩展名就返回
                //     // echo '<p style="color:#aa0000">path err </p>';
                //     return;
                // }

                $record = "";
                if (file_exists($fil)) {
                    DFLine();
                    unlink($fil);
                    $re = move_uploaded_file($tmp, $fil);
                    echo 'upload <font color=#808080>' . $fileName[$i] . '</font> &nbsp status <font color=#ff8000> 1</font>√:<font color=#60cc80>', $re . '</font><br>';
                    $record = $fileName[$i] . "\tstate 1√:" . $re;
                } else {
                    DFLine();
                    $re = move_uploaded_file($tmp, $fil);
                    // echo 'ret ',$ret;
                    echo 'upload <font color=#808080>' . $fileName[$i] . '</font> &nbsp status <font color=#60ccff> 0</font>√:<font color=#60cc80>', $re . '</font><br>';
                    $record = $fileName[$i] . "\tstate 0√:" . $re;
                }
                IPUploadRecord($record);
            }
        } else {
            mkdir($folder, 0777);

            for ($i = 0; $i < count($fileName); $i++) {
                $tmp = $_FILES[$varFileName]["tmp_name"][$i];
                $fil = $folder . '/' . $fileName[$i];
                move_uploaded_file($tmp, $fil);
            }
        }
        DFLine();
    } else {
        echo '<br><br>';
        // DFT(); // phpinfo();
    }
}


function DFLine($str = '')
{
    if ($str == '-') {
        echo '--------------------------';
    } else {
        echo $str;
    }
    echo PHP_EOL;
    echo '<br>';
}

function DFT()
{
    date_default_timezone_set('prc');
    $data = date('y-m-d H:i:s', time());
    echo ':) ', $data;
}

//无论是普通数组还是关联数组 都可以使用foreach, 关联数组其实就是字典,普通数组k就是索引编号
function PrintDict($dict)
{
    echo '<pre>';
    // print_r($dict);//用于打印多层嵌套数组 结构清晰
    echo '<br>__start__<br>';
    foreach ($dict as $k => $v) {

        echo '<font color="#00bb00">k: </font>' . $k;
        echo '<font color="#00bb00"> v: </font>';

        if ($v != null) {
            var_dump($v);
        } else {
            echo 'v is null';
        }
        echo '<br>';
    }
    echo '__end__<br>';
    echo '</pre>';
}

?>