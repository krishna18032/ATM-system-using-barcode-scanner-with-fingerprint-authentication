<?php 

$db_username = 'root';
$db_password = '';
$db_name = 'qrcode';
$db_host = 'localhost';
$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);						

$db = mysqli_connect('localhost', 'root', '', 'qrcode');
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}

if(isset($_POST['send'])){
	
	$arr= array();
	$data = mysqli_real_escape_string($db, $_POST['credential']);
	
	$query = "INSERT INTO data (data) VALUES('$data')";
  	mysqli_query($db, $query);
    
    if ($_POST['credential'] == 'momo') {
	    $arr['success'] = true;
	} else {
		$arr['success'] = false;
	}

		echo json_encode($arr);
	}

?>