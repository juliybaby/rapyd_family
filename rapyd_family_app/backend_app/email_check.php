
<?php

error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
//set_time_limit(300);



require('data6rst.php');
 if(isset($_POST['token']) && $_POST['token'] == '101201')
    {
$email = strip_tags($_POST['email']);
$result = $db->prepare('SELECT * FROM users where email = :email');

		$result->execute(array(
			':email' => $email
    ));
$nosofrows = $result->rowCount();
echo $nosofrows;
}

?>