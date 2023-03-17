<!DOCTYPE html>
<html>
<head>
  <title>methods</title>
</head>
<style>
body {
  font-size: 120%;
  background-image:url("scanner.jpg");
  background-repeat:no-repeat;
  background-size:1250px 650px;  
}
</style>
<form action="POST">
<link rel="stylesheet" type="text/css" href="qrstyle.css">
<script type="text/javascript" src="./main1.js"></script>
<script type="text/javascript" src="./llqrcode.js"></script>
<br>
<center><div style="display:none" id="result"></div></center>
	<div class="selector" id="webcamimg" onclick="setwebcam()" align="left" ></div>
		<div class="selector" id="qrimg" onclick="setimg()" align="right" ></div>
			<center id="mainbody"><div id="outdiv"></div></center>
				<canvas id="qr-canvas" width="800" height="600"></canvas>
<name="qrcode" style="float:right">
<script type="text/javascript">load();</script>
<script src="./jquery-1.11.2.min.js"></script>
</form>
</body>
</html>