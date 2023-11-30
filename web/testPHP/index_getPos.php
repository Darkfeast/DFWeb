<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Security-Policy">
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

    <button onclick="printT()">test</button>

    <script>
    function printT() {
        alert("test");
    }
    </script>


    <p id="demo"> getPos </p>
    <button onclick="getLocation()">点我</button>

    <form oninput="x.value=parseInt(a.value)+parseInt(b.value)">0
        <input type="range" id="a" value="50">100
        +<input type="number" id="b" value="50">
        =<output name="x" for="a b"></output>    
    </form>

    <!--<output name="x" for="a b"></output>  name="x"   也可以换成id="x"  依然能正常运行-->



    <script>
    function getLocation() {

        alert("get");
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPos, showErr);
        } else {
            x.innerHTML = "该浏览器不支持获取地理位置。";
        }
    }

    var x = document.getElementById("demo");

    function showPos(pos) {
        x.innerHTML = "纬度: " + pos.coords.latitude + "<br>经度: " + pos.coords.longitude;
        // x.innerHTML = "纬度: " + position.coords.latitude + "<br>经度: " + position.coords.longitude;
    }

    function showErr(error) {
        switch (error.code) {
            case error.PERMISSION_DENIED:
                x.innerHTML = "用户拒绝对获取地理位置的请求。"
                break;
            case error.POSITION_UNAVAILABLE:
                x.innerHTML = "位置信息是不可用的。"
                break;
            case error.TIMEOUT:
                x.innerHTML = "请求用户地理位置超时。"
                break;
            case error.UNKNOWN_ERROR:
                x.innerHTML = "未知错误。"
                break;
        }
    }
    </script>

</body>

</html>