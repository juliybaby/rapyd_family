
<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
//set_time_limit(300);

include('data6rst.php');

$id=strip_tags($_POST['id']);


$del = $db->prepare('DELETE FROM families where id = :id');

		$del->execute(array(
			':id' => $id
    ));


if($del){

echo 1;
}else{

echo 0;
}






?>


