<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 

$email = strip_tags($_POST['email']);
$password = strip_tags($_POST['password']);


if ($email == ''){
echo "<div class='alert alert-danger' id='alerts_login'><font color=red>Email is empty</font></div>";
exit();
}


if ($password == ''){
echo "<div class='alert alert-danger' id='alerts_login'><font color=red>password is empty</font></div>";
exit();
}


// honey pot spambots
$emailaddress_pot =$_POST['emailaddress_pot'];
if($emailaddress_pot !=''){
//spamboot detected.
//Redirect the user to google site

echo "<script>
window.setTimeout(function() {
    window.location.href = 'https://google.com';
}, 1000);
</script><br><br>";

exit();
}





include('data6rst.php');
$result = $db->prepare('SELECT * FROM users where email = :email');

		$result->execute(array(
			':email' => $email

    ));

$count = $result->rowCount();

$row = $result->fetch();

if( $count == 1 ) {





//start hashed passwordless Security verify
if(password_verify($password,$row["password"])){
            //echo "Password verified and ok";



$userid = $row['id'];
$fullname = $row['fullname'];
$username = $row['id'];
$email = $row['email'];
$photo = $row['photo'];
$user_rank = $row['user_rank'];
$status = $row['status'];



// initialize session if things where ok via html5 local storage.
echo "<script>


//localStorage.setItem('useridsessdatafa', '$userid');


localStorage.setItem('useridsessdatafa', '$userid');
localStorage.setItem('fullnamesessdatafa', '$fullname');
localStorage.setItem('usernamesessdatafa', '$username');
localStorage.setItem('emailsessdatafa', '$email');
localStorage.setItem('photosessdatafa', '$photo');
localStorage.setItem('statussessdatafa', '$status');
localStorage.setItem('userranksessdatafa', '$user_rank');



</script>";





echo "<div class='alert alert-success'>Login sucessful <img src='ajax-loader.gif'></div>";
echo "<script>window.location='dashboard.html'</script>";



}
else{
echo "<div class='alert alert-danger' id='alerts_login'><font color=red>Password Does not Matched</font></div>";

}



}
else {
echo "<div class='alert alert-danger' id='alerts_login'><font color=red>User with This Email does not exist..</font></div>";
}






?>

<?php ob_end_flush(); ?>
