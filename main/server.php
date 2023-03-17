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

 
 if(isset($_POST['Enter'])) {
	
	$phonenumber = mysqli_real_escape_string($db, $_POST['phonenumber']);
    $query = "INSERT INTO deposit (phonenumber) VALUES('$phonenumber')";
  	mysqli_query($db, $query);
	if (empty($phonenumber)) { 
        array_push($errors, "phone number is required"); 
	}
    else {
		if (mb_strlen($phonenumber) == 10)
		{
		header('location: depositAmount.php');
		}
		else{
			$n=mb_strlen($phonenumber);
			array_push($errors, "you have Entered $n digit only but Ten digit mobile number is required");
			}
		}
	}
if(isset($_POST['insert-card'])) {
	header('location: select-language.php');
	}
if(isset($_POST['deposit'])) {
	header('location: deposit.php');
	}
if(isset($_POST['qrcode'])) {
	header('location: qrselect-language.php');
	}
if(isset($_POST['proceed'])) {
	$authKey = "327740AhsRj5pXd5eabf55fP1";
    $senderId = "SONISH";
	$Amount = mysqli_real_escape_string($db, $_POST['Amount']);
	$A=$Amount+10535;
	if (empty($Amount)) { 
        array_push($errors, "Amount is required"); 
	}
	else {
    $user_check_query="SELECT * FROM deposit ORDER BY phonenumber DESC LIMIT 1";
	$result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
	$new =$user['phonenumber'];
	$fields = array(
    "sender_id" => "TXTIND",
    "message" => "RS.$Amount,.00 Credited to SB-xxx1234 AcBal:$A",
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
}
}
 if(isset($_POST['Close'])) {
	
    $query = "DELETE FROM deposit";
  	mysqli_query($db, $query);
    		
	header('location: starting.php');
		
}
if(isset($_POST['End'])) {
	header('location: starting.php');
}
?>