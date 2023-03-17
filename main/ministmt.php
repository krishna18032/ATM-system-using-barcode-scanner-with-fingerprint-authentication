<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
</head>
<style>
body {
  font-size: 120%;
  background-image:url("mini.jpg");
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
</style>
<center>
<h5 style="color:white">TAMILNADU  GOVERNMENT  BANK - CHENNAI</h5>
<h5 style="color:white">Account Number:xxxxxxxxxxxxxxx9</h5>
<h5 style="color:white">TXN.NO          :1234</h5>
<h5 style="color:white">Statement For:xxxxxxxxxxxx4529</h5>
<table style="width:30%;background-color:#fcaf2b;">
<tr>
<th>Amount</th>
<th>Type</th>
</tr>
<?php
include('server1.php');
$query = 'SELECT * FROM qramount';
$result = mysqli_query($db,$query) or die (mysqli_error());
$row = mysqli_fetch_array($result);

while($row = mysqli_fetch_array($result))
{
?>
<center>
<table style="width:30%;background-color:#fcaf2b;">
<td><?php echo $row['Amount'];?></td>
<td><?php echo $row['Type'];?></td>
</tr>
</center>
</table>
</body>
</html>
<?php
}
?>
<?php
$user_check_query="SELECT * FROM qramount where Type='credited' LIMIT 1";
$result = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($result);
?>
<center>
<h3 style="color:white";>Account Balance:<?php echo $user['Amount'];?></h3>
</center>