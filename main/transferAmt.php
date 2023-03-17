<?php include('server2.php') ?>
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
   background-size:1250px 650px; 
}
.input-group input {
  position: relative;
  top: 25px;
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
  top: 240px;
  left: 75px;
  padding: 10px;
  font-size: 20px;
  color: #ab0e9b;
  background: white;
  border: none;
  border-radius: 10px;
}
.error {
  width: 30%; 
  margin: 0px auto; 
  padding: 10px; 
  border: 1px solid #a94442; 
  color: #a94442; 
  background: none; 
  border-radius: 5px; 
  text-align: center;
}
.success {
  color: #3c763d; 
  background: #39b3d7; 
  border: 1px solid #3c763d;
  margin-bottom: 20px;
}
</style>
  <form method="POST">
    <!--display validation errors here-->
  	<?php include('errors.php'); ?>
	<br></br>
	<br></br>
  	 <div class="input-group">
  	  <input type="number" name="Amt" placeholder="Enter the amount" value="<?php echo $Amt; ?>">
  	 </div>
	 <br></br>
	 <div class="input-group">
  	  <button type="submit" class="btn" name="transferAmt">Enter</button>
	 </div>
  </form>
</body>
</html>