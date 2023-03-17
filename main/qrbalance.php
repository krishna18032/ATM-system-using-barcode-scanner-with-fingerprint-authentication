<!DOCTYPE html>
<html>
<head>
<title>balance</title>
</head>
<style>
body
{
  font-size: 120%;
  background-image:url("bal.jpg");
  background-repeat:no-repeat;
   background-size:1250px 650px; 
}
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
<center>
<h5 style="color:white">TAMILNADU  GOVERNMENT  BANK - CHENNAI</h5>
<h5 style="color:white">Account Number:xxxxxxxxxxxxxxx9</h5>
<h5 style="color:white">TXN.NO          :1234</h5>
<h5 style="color:white">Statement For:xxxxxxxxxxxx4529</h5>
<?php
include('server1.php');
$user_check_query="SELECT * FROM qramount where Type='credited' LIMIT 1";
$result = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($result);
?>
<center>
<h2 style="color:#FF0000";>Account Balance:<?php echo $user['Amount'];?></h2>
<center>
</body>
</html>