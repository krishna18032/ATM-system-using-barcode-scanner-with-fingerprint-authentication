<style>
body {
  font-size: 120%;
  background-image:url("FINGER PRINT.jpg");
  background-repeat:no-repeat;
background-size:1250px 630px;  
 }
 </style>
<script>
history.pushState(null, document.title, location.href);
window.addEventListener('popstate', function (event)
{
  history.pushState(null, document.title, location.href);
});
</script>
<?php 
$db_username = 'root';
$db_password = '';
$db_name = 'qrcode';
$db_host = 'localhost';
$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);						

$db = mysqli_connect('localhost', 'root', '', 'qrcode');

 


if(!isset($_SESSION['submit']))
{
  $_SESSION['securityquestion1'] = '';
  $_SESSION['securityanswer1'] = '';
  $_SESSION['securityquestion2'] = '';
  $_SESSION['securityanswer2'] = '';
}
$user_check_query="SELECT * FROM `rough`";
$result = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($result);
$data=$user['name'];
$user_check_query="SELECT * FROM `bio` WHERE name='$data' LIMIT 3";
$result = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($result);
if ($user['name'] == $data)
{
?> 
<div style = "position:relative; left:1030px; top:53px;">
    <img src="<?php echo $user['images']; ?>" width="160" height="160" > 
	</div>
	<div style = "color: white">
	<strong><pre>   Name       :<?php echo $user['name']; ?></br>
   Account_no :<?php echo $user['account']; ?></pre></strong>
    </div>
   <div style = "position:relative; right:-480px; top:67px;"><img src="https://i.pinimg.com/originals/b0/0c/92/b00c92e2a04a1ce04e31ff53205bad4f.gif" width="275" height="172">
</div>
<?php
}
?>
<?php
$user_check_query="SELECT * FROM `rough`";
$result = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($result);
$data=$user['name'];
$user_check_query="SELECT * FROM `fprint` WHERE name='$data' LIMIT 3";
$result = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($result);
if ($user['name'] == $data) {
  $user_check_query="SELECT * FROM `fprint` WHERE name='$data' LIMIT 3";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  $fp = $user["fb"];
  }
else{
$fb="12345";
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>user-login</title>
 
<script src="jquery-1.8.2.js"></script>
<script src="mfs100-9.0.2.6.js"></script>

<script language="javascript" type="text/javascript">


        var quality = 60; //(1 to 100) (recommanded minimum 55)
        var timeout = 10; // seconds (minimum=10(recommanded), maximum=60, unlimited=0 )
        var flag = 0;

// Function used to match fingerprint using jason object 

function Match() {

            try {
              //fingerprint stored as isotemplate

                var isotemplate = <?php echo json_encode($fp); ?>;
                var res = MatchFinger(quality, timeout, isotemplate);

                if (res.httpStaus) {
                    if (res.data.Status) {
                        alert("Finger matched");
						<?php
						$query = "DELETE FROM `rough`";
	mysqli_query($db, $query);
	?>
                        self.location.replace('thome1.php');
                        //variable flag used for authentication 
                        
                        flag=1;
                    }
                    else {
                        if (res.data.ErrorCode != "0") {
                            alert(res.data.ErrorDescription);
                        }
                        else {
                            alert("Finger not matched");
                        }
                    }
                }
                else {
                    alert(res.err);
                }
            }
            catch (e) {
                alert(e);
            }
            return false;

        }

//function to redirect to next page upon fingerprint matching

function redirect(){

    
    if(flag){ 
    window.location.assign("url"); 
    }
    else{
      alert("Scan Your Finger");
    }

  return false;
}

</script>

</head>
<body class="mainbody">
  

    <div class="register_panel">
      <div class="panel panel-primary">
          <div class="panel-heading font"> </div>
          <div class="panel-body">
                <form method = "post" name="myForm" action="#">
                    </br>                             
                    
                    


                     <div style = "position:relative; left:538px; top:78px; font-size: 23px;">
                      <button type="input" onclick="return Match()" class="btn btn-default padd" style = "padding: 5px; border: 1px solid #a94442; font-size: 23px; color: #ab0e9b; background: none; border: none; border-radius: 5px;">start scanning</button>
                    </div>
                    
                    </div>
                    

                    
                    
                    </div>
               </form>
          </div>
       </div>
    </div>
</body>
</html>