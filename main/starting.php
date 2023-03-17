<?php include('server.php')

 ?>
<!DOCTYPE html>
<html>
<head>
  <title>methods</title>
 
</head>
<style>
body {
  font-size: 120%;
  background-image:url("starting.jpg");
  background-repeat:no-repeat;
  background-size:cover;  
}
.btn {
  position: relative;
  top: 80px;
  left: 75px;
  padding: 10px;
  font-size: 20px;
  color: #ab0e9b;
  background: none;
  border: none;
  border-radius: 10px;
}
.btn1 {
  position: relative;
  top: 250px;
  left:85px;
  padding: 10px;
  font-size: 20px;
  color: #ab0e9b;
  background: none;
  border: none;
  border-radius: 10px;
}
.btn2 {
  position: relative;
  top: 545px;
  left: 95px;
  padding: 10px;
  font-size: 20px;
  color: #ab0e9b;
  background: none;
  border: none;
  border-radius: 10px;
}
 </style>
    <form method="POST">
	  <div class="input-group">
  	  <button type="submit" class="btn2" name="insert-card">Card</button>
	 </div>
	 <div class="input-group">
  	  <button type="submit" class="btn" name="qrcode">QR code</button>
	 </div>
	 <div class="input-group">
	 <button type="submit" class="btn1" name="deposit">Deposit</button>
	 </div>
  </form>
   
</body>
</html>