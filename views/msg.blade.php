<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>提示信息</title>
    <style type="text/css">
        html {
            background: #eee;
        }
        body {
            background: #fff;
            color: #333;
            font-family: "微软雅黑","Microsoft YaHei", sans-serif;
            margin: 2em auto;
            padding: 1em 2em;
            max-width: 700px;
            -webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.13);
            box-shadow: 0 1px 3px rgba(0,0,0,0.13);
        }
        h1 {
            border-bottom: 1px solid #dadada;
            clear: both;
            color: #666;
            font: 24px "微软雅黑","Microsoft YaHei",, sans-serif;
            margin: 30px 0 0 0;
            padding: 0;
            padding-bottom: 7px;
        }
        #error-page {
            margin-top: 50px;
        }
        #error-page p {
            font-size: 9px;
            line-height: 1.5;
            margin: 25px 0 20px;
        }
        #error-page code {
            font-family: Consolas, Monaco, monospace;
        }
        ul li {
            margin-bottom: 10px;
            font-size: 9px ;
        }
        a {
            color: #21759B;
            text-decoration: none;
        }
        a:hover {
            color: #D54E21;
        }
        .button {
            background: #f7f7f7;
            border: 1px solid #cccccc;
            color: #555;
            display: inline-block;
            text-decoration: none;
            font-size: 13px;
            line-height: 26px;
            height: 28px;
            margin: 0;
            padding: 0 10px 1px;
            cursor: pointer;
            -webkit-border-radius: 3px;
            -webkit-appearance: none;
            border-radius: 3px;
            white-space: nowrap;
            -webkit-box-sizing: border-box;
            -moz-box-sizing:    border-box;
            box-sizing:         border-box;

            -webkit-box-shadow: inset 0 1px 0 #fff, 0 1px 0 rgba(0,0,0,.08);
            box-shadow: inset 0 1px 0 #fff, 0 1px 0 rgba(0,0,0,.08);
            vertical-align: top;
        }

        .button.button-large {
            height: 29px;
            line-height: 28px;
            padding: 0 12px;
        }

        .button:hover,
        .button:focus {
            background: #fafafa;
            border-color: #999;
            color: #222;
        }

        .button:focus  {
            -webkit-box-shadow: 1px 1px 1px rgba(0,0,0,.2);
            box-shadow: 1px 1px 1px rgba(0,0,0,.2);
        }

        .button:active {
            background: #eee;
            border-color: #999;
            color: #333;
            -webkit-box-shadow: inset 0 2px 5px -3px rgba( 0, 0, 0, 0.5 );
            box-shadow: inset 0 2px 5px -3px rgba( 0, 0, 0, 0.5 );
        }
    </style>
</head>
<body id="error-page">
    <h3>提示信息</h3>
    {{$msg}}<br/><br/>
    <a href="{{$url}}">如果您的浏览器没有自动跳转，请点击此处</a>
</body>
<script>
setTimeout(function (){
    location.href = '{{$url}}';
}, 3000);
</script>
</html>
