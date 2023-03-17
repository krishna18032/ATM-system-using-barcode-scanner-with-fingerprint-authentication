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
	header('location: tverification.php');
	
}
if(isset($_POST['withdraw'])) {
	header('location: tcardcurrent.php');
	}
if(isset($_POST['current'])) {
	header('location: tcardwithdrawl.php');
	}
if(isset($_POST['deposit'])) {
	header('location: tcardwithdrawl.php');
	}
if(isset($_POST['CardAmt'])) {
	$A = mysqli_real_escape_string($db, $_POST['Amount']);
	if (empty($A)) { 
        array_push($errors, "தொகை தேவை"); 
	}
	else {
		if ($A < 10000) {
		$mod=$A % 100;
		$user_check_query="SELECT * FROM cdamount where Type='credited' LIMIT 1";
		$result = mysqli_query($db, $user_check_query);
		$user = mysqli_fetch_assoc($result);
		$Amount = $user['Amount'] - $A;
		if ($mod == 0){
			$query = "INSERT INTO cdamount (Amount,Type) VALUES('$A','Debited')";
			mysqli_query($db, $query);
			$query = "DELETE FROM `cdamount` WHERE  Type='credited' LIMIT 1";
			mysqli_query($db, $query);
			$query = "INSERT INTO cdamount (Amount,Type) VALUES('$Amount','credited')";
			mysqli_query($db, $query);
			header('location: cardclose.php');
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
if(isset($_POST['verify'])) {
	
	$PIN = mysqli_real_escape_string($db, $_POST['PIN']);
    if (empty($PIN)) { 
        array_push($errors, "ரகசிய எண் தேவை"); 
	}
	else {
		$user_check_query="SELECT * FROM pin";
		$result = mysqli_query($db, $user_check_query);
		$user = mysqli_fetch_assoc($result);
		if ($PIN === $user['PIN']) {
	     	header('location: tamilcardhome.php');
		}
		else {
		array_push($errors, "தவறான  ரகசிய எண்"); 
		}
	}   
}
if(isset($_POST['Pin-Change'])) {
	$query = "DELETE FROM pin";
  	mysqli_query($db, $query);
    header('location: tchangepin.php');
}
if(isset($_POST['change'])) {
	$NEW = mysqli_real_escape_string($db, $_POST['NEW']);
	if (empty($NEW)) { 
        array_push($errors, "புதிய ரகசிய எண் தேவை"); 
	}
	else {
		if (mb_strlen($NEW) == 4){
		$query="INSERT INTO pin (PIN) VALUES('$NEW')";
		$result = mysqli_query($db, $query);
		header('location: tamilcardhome.php');
		}
		else{
			$n=mb_strlen($NEW);
			array_push($errors, "நீங்கள் $n இலக்கங்களை உள்ளிட்டுள்ளீர்கள், ஆனால் நான்கு இலக்க ரகசிய எண் தேவை");
			}
		}
	}
if(isset($_POST['Mini-statement'])) {
    header('location: tcardmini.php');
}
if(isset($_POST['Balance-enqury'])) {
	header('location: tcardbalance.php');
}
if(isset($_POST['Deposit'])) {
	header('location: tcarddepositamount.php');
}
if(isset($_POST['go'])) {
	$authKey = "327740AhsRj5pXd5eabf55fP1";
      $senderId = "SONISH";
	$A = mysqli_real_escape_string($db, $_POST['Amount']);
	if (empty($A)) { 
        array_push($errors, "தொகை தேவை"); 
	}
	else {
		if ($A < 10000) {
		$mod=$A % 100;
		$user_check_query="SELECT * FROM cdamount where Type='credited' LIMIT 1";
		$result = mysqli_query($db, $user_check_query);
		$user = mysqli_fetch_assoc($result);
		$Amount = $user['Amount'] + $A;
		echo $Amount;
		if ($mod == 0){
			$query = "INSERT INTO cdamount (Amount,Type) VALUES('$A','credit')";
			mysqli_query($db, $query);
			$query = "DELETE FROM `cdamount` WHERE  Type='credited' LIMIT 1";
			mysqli_query($db, $query);
			$query = "INSERT INTO cdamount (Amount,Type) VALUES('$Amount','credited')";
			mysqli_query($db, $query);
			$user_check_query="SELECT * FROM deposit ORDER BY phonenumber DESC LIMIT 1";
	$result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
	$new =$user['phonenumber'];
	$fields = array(
    "sender_id" => "TXTIND",
    "message" => "done",
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
   header('location: Close.php');
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
if(isset($_POST['transfer'])) {
	header('location: tfunddata.php');
}
if(isset($_POST['Funddata'])) {
	$authKey = "327740AhsRj5pXd5eabf55fP1";
    $senderId = "SONISH";
	$Account = mysqli_real_escape_string($db, $_POST['Account']);
	$phnum = mysqli_real_escape_string($db, $_POST['phnum']);
	if (empty($Account)) { 
        array_push($errors, "Account number is required"); 
	}
	else{
		if (mb_strlen($Account) == 16)
		{
		 echo mb_strlen($Account);
		}
		else{
			$n=mb_strlen($Account);
			array_push($errors, "நீங்கள் $n இலக்கங்களை உள்ளிட்டுள்ளீர்கள், ஆனால்  பதினாறு இலக்க வங்கி கணக்கு எண் தேவை");
			}
		}
	if (empty($phnum)) { 
        array_push($errors, "மொபைல் எண் தேவை"); 
	}
    else {
		if (mb_strlen($phnum) == 10)
		{
		  $query = "INSERT INTO deposit (phonenumber) VALUES('$phnum')";
		  mysqli_query($db, $query);
		}
		else{
			$n=mb_strlen($phnum);
			array_push($errors, "நீங்கள் $n இலக்கங்களை உள்ளிட்டுள்ளீர்கள், ஆனால்  பத்து இலக்க  மொபைல் எண் தேவை");
			}
		}
		if (mb_strlen($phnum) == 10 and mb_strlen($Account) == 16){
			header('location: ttransferAmt.php');
		}
		else{
			array_push($errors, "மொபைல் அல்லது கணக்கு எண் தவறானது");
		}
	}
if(isset($_POST['transferAmt'])) {
		$A = mysqli_real_escape_string($db, $_POST['Amt']);
	if (empty($A)) { 
        array_push($errors, "தொகை தேவை"); 
	}
	else {
	if ($A < 10000){
		$mod=$A % 100;
		$user_check_query="SELECT * FROM cdamount where Type='credited' LIMIT 1";
		$result = mysqli_query($db, $user_check_query);
		$user = mysqli_fetch_assoc($result);
		$Amount = $user['Amount'] - $A;
		if ($mod == 0){
			$query = "INSERT INTO cdamount (Amount,Type) VALUES('$A','Debited')";
			mysqli_query($db, $query);
			$query = "DELETE FROM `cdamount` WHERE  Type='credited' LIMIT 1";
			mysqli_query($db, $query);
			$query = "INSERT INTO cdamount (Amount,Type) VALUES('$Amount','credited')";
			mysqli_query($db, $query);
			$user_check_query="SELECT * FROM deposit ORDER BY phonenumber DESC LIMIT 1";
	$result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
	$new =$user['phonenumber'];
	$fields = array(
    "sender_id" => "TXTIND",
    "message" => "done",
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
   header('location: close.php');
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
if(isset($_POST['Close'])) {
	header('location: starting.php');
}
?>