<?php include('server4.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Amount</title>
</head>
<style>
body {
  font-size: 120%;
  background-image:url("DEPOSIT.jpg");
  background-repeat:no-repeat;
   background-size:1250px 650px; 
}
.btn {
  position: relative;
  top: 100px;
  right: 610px;
  padding: 15px;
  font-size: 15px;
  color: #ab0e9b;
  background: white;
  border: none;
  border-radius: 10px;
}
* {
  margin: 0px;
  padding: 0px;
}

.header {
  width: 30%;
  margin: 10px auto 0px;
  color: white;
  text-align: center;
  border: green;
  border-bottom: white;
  border-radius: 0px 0px 0px 0px;
  padding: 10px;
}
form, .content {
  width: 30%;
  margin: 10px auto 0px;
  padding: 120px;
  border: 0px solid;
  background:  transparent;
  border-radius: 10px 0px 10px 10px;
}
.input-group {
  margin: 10px 0px 10px 0px;
}
.input-group label {
  display: block;
  text-align: left;
  margin: 3px;
}
.input-group input {
  height: 30px;
  width: 93%;
  padding: 0px 0px;
  font-size: 16px;
  border-radius: 5px;
  border: white;
}
.error {
  width: 92%; 
  margin: 0px auto; 
  padding: 10px; 
  border: 1px solid #a94442; 
  color: #a94442; 
  background: none; 
  border-radius: 5px; 
  text-align: left;
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
  	<center><h2 style="color:white">தொகை</h2></center>
	<br></br>
	<br></br>
  	 <div class="input-group">
  	  <input type="number" name="Amount" placeholder="தொகையை உள்ளிடவும்" value="<?php echo $Amount; ?>">
  	 </div>
	 <br></br>
	 <div class="input-group">
  	  <button type="submit" class="btn" name="go-head" style="float:right">உள்ளிடவும்</button>
	 </div>
  </form>
</body>
</html>