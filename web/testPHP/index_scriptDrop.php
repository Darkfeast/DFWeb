<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>.</title>


    <style type="text/css">
    #divDrop {
        width: 350px;
        height: 70px;
        padding: 10px;
        border: 1px solid #aaaaaa;
    }
    </style>
</head>

<body>


    <canvas id="c1" width="200" height="100" style="border:1px dashed purple">

    </canvas>


    <script>
    var c = document.getElementById("c1");
    var ctx = c.getContext("2d"); //2d是内置的名字，固定小写
    ctx.fillStyle = "#00ff0033"; //设置fillStyle属性可以是CSS颜色，渐变，或图案。fillStyle 默认设置是#000000（黑色）
    ctx.fillRect(0, 0, 200, 100); //fillRect(x,y,width,height)
    ctx.fillStyle = grd;

    // ctx.moveTo(0,0);
    // ctx.lineTo(200,100);
    // ctx.stroke();

    // ctx.beginPath();
    // ctx.arc(100, 50, 20, 0, 2 * Math.PI);
    // ctx.stroke();
    </script>


    <script>
    function dropOver(ev) {
        ev.preventDefault();
    }

    function drag(ev) {
        ev.dataTransfer.setData("Text2", ev.target.id);
    }

    function drop(ev) {

        var c1 = document.getElementById("c1");
        var ctx = c1.getContext("2d");
        ctx.fillStyle = "#00ff00";
        ctx.fillRect(0, 0, 200, 50);

        ev.preventDefault(); //调用 preventDefault() 来避免浏览器对数据的默认处理（drop 事件的默认行为是以链接形式打开）
        var data = ev.dataTransfer.getData("Text2");
        ev.target.appendChild(document.getElementById(data));
    }
    </script>

    <p>拖动图片到矩形框中:</p>

    <div id="divDrop" ondrop="drop(event)" ondragover="dropOver(event)"></div>
    <br>
    <img loading="lazy" id="imgObj" src="/res/upload/xxx.jpg" draggable="true" ondragstart="drag(event)" width="336"
        height="69">
    <img loading="lazy" src="/res/upload/xxx.jpg" draggable="true" width="336" height="30">

</body>

</html>