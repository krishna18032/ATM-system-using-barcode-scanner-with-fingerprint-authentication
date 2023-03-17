<?php include('server4.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>otp</title>
</head>
<style>
body {
  font-size: 120%;
  background-image:url("pinchange.jpg");
  background-repeat:no-repeat;
  background-size:1250px 630px;  
 }
.error {
  position: relative;
  top: 95px;
  right: 10px;
  width: 50%; 
  margin: 1px auto;
  padding: 10px; 
  border: 1px solid #a94442; 
  color: #a94442; 
  background:  transparent;
  border-radius: 5px; 
  text-align: center;
}
 * {
  margin: 0px;
  padding: 0px;
}
 
.input-group input {
  position: relative;
  top: 145px;
  left: 420px;
  height: 30px;
  width: 30%;
  padding: 0px 0px;
  font-size: 26px;
  border-radius: 5px;
  border: white;
}
.btn {
  position: relative;
  top: 345px;
  left: 90px;
  padding: 10px;
  font-size: 23px;
  color: #ab0e9b;
  background: white;
  border: none;
  border-radius: 5px;
}
.btn1 {
  position: relative;
  top: 410px;
  left: 85px;
  padding: 10px;
  font-size: 23px;
  color: #ab0e9b;
  background: white;
  border: none;
  border-radius: 5px;
}
</style>	
 
  <form method="POST" action="totp.php">
    <!--display validation errors here-->
  	<?php include('errors.php'); ?>
  	 <div class="input-group">
  	  <input type="number" name="ootp" placeholder="இங்கே otp ஐ உள்ளிடவும்" value="<?php echo $ootp; ?>">
  	 </div>
	 <div class="input-group">
  	  <button type="submit" class="btn" name="change">Enter</button>
	 </div>
	 <div class="input-group">
  	  <button type="submit" class="btn1" name="Cancel">Cancel</button>
	 </div>
  </form>
</body>
</html>