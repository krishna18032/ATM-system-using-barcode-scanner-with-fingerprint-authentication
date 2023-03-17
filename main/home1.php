<?php include('server1.php')
 ?>
<!DOCTYPE html>
<html>
<head>
  <title>methods</title>
</head>
<style>
body {
  font-size: 120%;
  background-image:url("card1.jpg");
  background-repeat:no-repeat;
   background-size:1250px 650px; 
}
.btn {
  position: relative;
  top: 200px;
  left: 275px;
  padding: 10px;
  font-size: 20px;
  color: #ab0e9b;
  background: none;
  border: none;
  border-radius: 10px;
}
.btn1 {
  position: relative;
  top: 110px;
  left: 574px;
  padding: 10px;
  font-size: 20px;
  color: #ab0e9b;
  background: none;
  border: none;
  border-radius: 10px;
}
.btn2 {
  position: relative;
  top: 245px;
  left: 255px;
  padding: 10px;
  font-size: 20px;
  color: #ab0e9b;
  background: none;
  border: none;
  border-radius: 10px;
}
.btn3 {
  position: relative;
  top: 335px;
  left: 610px;
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
  	  <button type="submit" class="btn" name="Amount-Withdrawal">Withdrawal</button>
	 </div>
	 <div class="input-group">
  	  <button type="submit" class="btn3" name="deposit">Deposit</button>
	 </div>
	 <div class="input-group">
  	  <button type="submit" class="btn1" name="Balance-Enqury">Balance-Enquiry</button>
	 </div>
	 <div class="input-group">
  	  <button type="submit" class="btn2" name="Mini-Statement">Mini-Statement</button>
	 </div>
	 
  </form>
   
</body>
</html>