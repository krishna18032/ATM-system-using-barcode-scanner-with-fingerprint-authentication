<?php include('server3.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Amount</title>
</head>
<style>
body {
  font-size: 120%;
  background-image:url("cardwithdraw.jpg");
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
  font-size: 15px;
  border-radius: 5px;
  border: white;
}
.btn {
  position: relative;
  top: 345px;
  left: 85px;
  padding: 10px;
  font-size: 15px;
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
  font-size: 15px;
  color: #ab0e9b;
  background: white;
  border: none;
  border-radius: 5px;
}
</style>
  <form method="POST">
  	<?php include('errors.php'); ?>
  	 <div class="input-group">
  	  <input type="number" name="Amount" placeholder="தொகையை உள்ளிடவும்" value="<?php echo $Amount; ?>">
  	 </div>
	 <div class="input-group">
  	  <button type="submit" class="btn" name="CardAmt">உள்ளிடவும்</button>
	 </div>
	 <div class="input-group">
  	  <button type="submit" class="btn1" name="Cancel">ரத்துசெய்</button>
	 </div>
  </form>
</body>
</html>