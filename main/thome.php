<!DOCTYPE html>
<html>
<head>
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
<?php
include('server2.php');
$user_check_query="SELECT * FROM `data`";
$result = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($result);
$data=$user['data'];
$user_check_query="SELECT * FROM `datas` WHERE name='$data' LIMIT 3";
$result = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($result);
if ($user['name'] == $data) {
	echo '<script>alert("Welcome to TGB");
	location="Biometric_match1.php";;
	</script>'; 
	$query = "DELETE FROM `data`";
	mysqli_query($db, $query);
	$user_check_query="SELECT * FROM `datas` WHERE name='$data' LIMIT 3";
	$result = mysqli_query($db, $user_check_query);
	$user = mysqli_fetch_assoc($result);
	$new =$user['number'];
	$query = "INSERT INTO ph (number) VALUES('$new')";
	mysqli_query($db, $query);
	$query = "INSERT INTO rough (name) VALUES('$data')";
	mysqli_query($db, $query);
	$fields = array(
    "sender_id" => "TXTIND",
    "message" => "Your verification code is:180320",
    "language" => "english",
    "route" => "p",
    "numbers" => $new,
    "flash" => "1"
);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode($fields),
  CURLOPT_HTTPHEADER => array(
    "authorization: DVqJmC2IKAE47lRSjOhYa8Uy5QnbHWzGXPuvgicF06etTr3dwMP530OSF9RowHJAfcVZk6MDexlCXqmL",
    "accept: */*",
    "cache-control: no-cache",
    "content-type: application/json"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}
}
else {
	echo '<script>alert("Invalid user");
	location="qrcode1.php";;
	</script>'; 
	$query = "DELETE FROM `data`";
	mysqli_query($db, $query);
}
?>

<center>
</body>
</html>
