<?php include('server2.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Amount</title>
</head>
<style>
body {
  font-size: 120%;
  background-image:url("FUND TRANSFER.jpg");
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
  top: 55px;
  left: 470px;
  height: 30px;
  width: 30%;
  padding: 0px 0px;
  font-size: 15px;
  border-radius: 5px;
  border: white;
}
.btn {
  position: relative;
  top: 245px;
  left: 90px;
  padding: 10px;
  font-size: 15px;
  color: #ab0e9b;
  background: white;
  border: none;
  border-radius: 5px;
}
</style>
  <form method="POST">
    <!--display validation errors here-->
  	<?php include('errors.php'); ?>
	<br></br>
	<br></br>
  	 <div class="input-group">
  	  <input type="number" name="Account" placeholder="வங்கி கணக்கு எண்ணை உள்ளிடவும்" value="<?php echo $Account; ?>">
  	 </div>
	 <br></br>
	 <div class="input-group">
  	  <input type="number" name="phnum" placeholder="மொபைல் எண்ணை உள்ளிடவும்" value="<?php echo $phnum; ?>">
  	 </div>
	 <div class="input-group">
  	  <button type="submit" class="btn" name="Funddata">உள்ளிடவும்</button>
	 </div>
  </form>
</body>
</html>