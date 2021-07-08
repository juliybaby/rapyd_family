<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
//set_time_limit(300);



$creator_id=strip_tags($_POST['creator9x_id']);


require('data6rst.php');
$result = $db->prepare('SELECT * FROM payers_bankinfo where creator_id =:creator_id');
		$result->execute(array(
':creator_id' => $creator_id
    ));
$nosofrows = $result->rowCount();
$rec_List1 = $nosofrows;


$v1 = $result->fetch();

$id = $v1['id'];
$status = $v1['status'];


 if($status != 'ok'){

echo "<style>
.fs_css{background:navy;color:white;padding:10px;font-size:20px;text-align:center;}
.fs_css:hover{background:orange;color:black;}
</style>";

	echo "<script>alert('Welcome Payer, Please You will need to Update your Rapyd Banking Info as Sender/Payer in this app first before trying to Send Fund/Payments. We will Redirect you in a Seconds'); </script>";
	
echo "<script>window.location='bank_info_update.html';</script>";
			
	echo "<div style='background:red;color:white;padding:10px;border:none;'>Hello Sender/Payer,</b>. 
Please You will need to Updates your Rapyd Banking Info as Fund Sender/Payers in this app first before trying to send Payments..We will redirect you in a seconds...........<br><br>
<br><center><a class='fs_css' title='Update Your Bank Info here' href='bank_info_update.html'>Update Your Bank Info here</a><center>
</div><br>";

			

exit();
}





?>

