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
if(isset($_POST['Amount-Withdrawal'])) {
	header('location: tqrcurrent.php');
	}
if(isset($_POST['current'])) {
	header('location: twithdrawl.php');
	}
if(isset($_POST['saving'])) {
	header('location: twithdrawl.php');
	}
if(isset($_POST['withdrawl'])) {
	$A = mysqli_real_escape_string($db, $_POST['Amount']);
	if (empty($A)) { 
        array_push($errors, "தொகை தேவை"); 
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
			$user_check_query="SELECT * FROM ph";
			$result = mysqli_query($db, $user_check_query);
			$user = mysqli_fetch_assoc($result);
		    $new =$user['number'];
			$message = 'welcome :***';
	
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
   header('location: totp.php');
	}
			}
	else {
	array_push($errors, "x100 உடன் சரியான தொகையை உள்ளிடவும்"); 
	}
		}
		else{
			array_push($errors, "10000 க்கும் குறைவான தொகையை உள்ளிடவும்"); 
		}
	}
}
if(isset($_POST['Mini-Statement'])) {
    header('location: tministmt.php');
}
if(isset($_POST['Balance-Enqury'])) {
	header('location: tqrbalance.php');
	}
if(isset($_POST['deposit'])) {
	header('location: tqrdepositamount.php');
}

if(isset($_POST['go-head'])) {
	$A = mysqli_real_escape_string($db, $_POST['Amount']);
	if (empty($A)) { 
        array_push($errors, "தொகை தேவை"); 
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
   header('location: totp.php');
		}
		}
		else{
			array_push($errors, "x100 உடன் சரியான தொகையை உள்ளிடவும்"); 
			}
	}
		else{
			array_push($errors, "10000 க்கும் குறைவான தொகையை உள்ளிடவும்"); 
			}
	}
}
if(isset($_POST['totp'])) {
	
	$PIN = mysqli_real_escape_string($db, $_POST['totp']);
	$n=mb_strlen($PIN);			
	
    if (empty($PIN)) { 
        array_push($errors, "otp தேவை உங்கள் மொபைல் தொலைபேசியை சரிபார்க்கவும்"); 
	}
	else {
		if (mb_strlen($PIN) == 6){
			if ($PIN == 180320) {
	     	header('location: end.php');
			}
		else {
		array_push($errors, "தவறான  OTP எண்"); 
		}
		}
		else{
			array_push($errors, "நீங்கள் $n இலக்கங்களை உள்ளிட்டுள்ளீர்கள், ஆனால் ஆறு இலக்க ரகசிய எண் தேவை");
		}		
	}   
} 
if(isset($_POST['End'])) {
	header('location: starting.php');
	
}
?>