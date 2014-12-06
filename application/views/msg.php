<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>提示信息</title>
<meta name="Robots" content="NOINDEX, NOFOLLOW, NOARCHIVE" />
<meta name="ViewPort" content="initial-scale=1, minimum-scale=1, width=device-width" />
<style>
html, body { width: 100%; height: 100%; }
html, body, p, h2, div { margin: 0; padding: 0; }
body { background: #f2f2f2; }
html { font: 12px "Segoe UI", "Microsoft YaHei", Arial, helvetica, sans-serif; }
.box { position: relative; top: 75px; width: 650px; max-width: 90%; margin: 0 auto; background: #fff; padding: 15px; border: 1px solid #e5e5e5; }
.main { font-size: 14px; color: #000; }
.foot { text-align: center; margin: 90px 15px 0; color: #bcbcbc; font-size: 10px; }
h2 { margin-bottom: 20px; font-size: 24px; }
p { line-height: 1.5em; margin: 0 5px .7em; color: #888; }
pre { border-top: 1px solid #e5e5e5; background: #f7f7f7; padding: 10px 20px; margin: 20px -15px -15px; line-height: 18px; }
a { text-decoration: none; }
</style>
</head>
<body>
<div class="box">
<h2>提示信息</h2>
<p class="main"><?php echo $msg; ?></p>
<p><a href="<?php echo $url; ?>">如果您的浏览器没有自动跳转，请点击此处</a></p>
</div>
<p class="foot">Powered by Geekeye Payment</p>
</body>
<script>
setTimeout(function (){
    location.href = '<?php echo $url; ?>';
}, 3000);
</script>
</html>
