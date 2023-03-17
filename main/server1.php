<?php
session_start();



$db_username = 'root';
$db_password = '';
$db_name = 'qrcode';
$db_host = 'localhost';
 		
$mysqli = new mysqli($db_host, $db_username, $db_password,$db_name);						
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'qrcode');
if(isset($_POST['Tamil'])) {
	header('location: qrcode1.php');
	
}
if(isset($_POST['English'])) {
	header('location: qrcode.php');
	
}
if(isset($_POST['Amount-Withdrawal'])) {
	header('location: qrcurrent.php');
	}
if(isset($_POST['current'])) {
	header('location: withdrawl.php');
	}
if(isset($_POST['saving'])) {
	header('location: withdrawl.php');
	}
if(isset($_POST['withdrawl'])) {
	$A = mysqli_real_escape_string($db, $_POST['Amount']);
	if (empty($A)) { 
        array_push($errors, "Amount is required"); 
	}
	else {
	$mod=$A % 100;
	$user_check_query="SELECT * FROM qramount where Type='credited' LIMIT 1";
	$result = mysqli_query($db, $user_check_query);
	$user = mysqli_fetch_assoc($result);
	$Amount = $user['Amount'] - $A;
		if ($A < 10000) {
			if ($mod == 0){
			$query = "INSERT INTO qramount (Amount,Type) VALUES('$A','Debited')";
			mysqli_query($db, $query);
			$query = "DELETE FROM `qramount` WHERE  Type='credited' LIMIT 1";
			mysqli_query($db, $query);
			$query = "INSERT INTO qramount (Amount,Type) VALUES('$Amount','credited')";
			mysqli_query($db, $query);
			$user_check_query="SELECT * FROM `ph`";
			$result = mysqli_query($db, $user_check_query);
			$user = mysqli_fetch_assoc($result);
			$new=$user['number'];
			$fields = array(
    "sender_id" => "TXTIND",
    "message" => "RS.$A.00 Debited to SB-xxx1234 AcBal:$Amount",
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
   header('location: otp.php');
	}
			}
	else {
	array_push($errors, "please enter a valid amount with x100"); 
	}
		}
		else{
			array_push($errors, "please enter a amount less than 10000"); 
		}
	}
}
if(isset($_POST['Mini-Statement'])) {
    header('location: ministmt.php');
}
if(isset($_POST['Balance-Enqury'])) {
	header('location: qrbalance.php');
	}
if(isset($_POST['deposit'])) {
	header('location: qrdepositamount.php');
}

if(isset($_POST['go-head'])) {
	$authKey = "327740AhsRj5pXd5eabf55fP1";
    $senderId = "SONISH";
	$A = mysqli_real_escape_string($db, $_POST['Amount']);
	if (empty($A)) { 
        array_push($errors, "Amount is required"); 
	}
	else {
		if ($A < 10000) {
		$mod=$A % 100;
		$user_check_query="SELECT * FROM qramount where Type='credited' LIMIT 1";
		$result = mysqli_query($db, $user_check_query);
		$user = mysqli_fetch_assoc($result);
		$Amount = $user['Amount'] + $A;
		echo $Amount;
		if ($mod == 0){
			$query = "INSERT INTO qramount (Amount,Type) VALUES('$A','credit')";
			mysqli_query($db, $query);
			$query = "DELETE FROM `qramount` WHERE  Type='credited' LIMIT 1";
			mysqli_query($db, $query);
			$query = "INSERT INTO qramount (Amount,Type) VALUES('$Amount','credited')";
			mysqli_query($db, $query);
			$user_check_query="SELECT * FROM deposit ORDER BY phonenumber DESC LIMIT 1";
	$result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
	$new =$user['phonenumber'];
	$fields = array(
    "sender_id" => "TXTIND",
    "message" => "RS.$A.00 Credited to SB-xxx1234 AcBal:$Amount",
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
   header('location: end.php');
		}
		}
		else{
			array_push($errors, "please enter a valid amount with x100"); 
			}
	}
		else{
			array_push($errors, "please enter a amount less than 10000"); 
			}
	}
}
if(isset($_POST['ootp'])) {
	
	$PIN = mysqli_real_escape_string($db, $_POST['ootp']);
	$n=mb_strlen($PIN);			
	
    if (empty($PIN)) { 
        array_push($errors, "OTP is required please check your mobile phone"); 
	}
	else {
		if (mb_strlen($PIN) == 6){
			if ($PIN == 180320) {
			$query = "DELETE FROM `ph`";
			mysqli_query($db, $query);
	     	header('location: end.php');
			}
		else {
		array_push($errors, "Invalid OTP pin"); 
		}
		}
		else{
			array_push($errors, "you have Entered $n digits but six digit otp number is required");
		}		
	}   
}
 
if(isset($_POST['End'])) {
	header('location: starting.php');
	
}
?>