
<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
//set_time_limit(300);




$id=strip_tags($_POST['id']);
$payout_id=strip_tags($_POST['payout_id']);
$payout_status=strip_tags($_POST['payout_status']);
$creator_id=strip_tags($_POST['creator_id']);
$amount=strip_tags($_POST['salary']);



// complete Payout
include('utilities.php');
try {
    $object = make_request('post', "/v1/payouts/complete/$payout_id/$amount");
    //var_dump($object);
	
	
$json1_res = json_decode(json_encode($object), true);

$json2_res = json_encode($json1_res, true);
//print_r($json1_res);

$complete_success = $json1_res['status']['status'];
$complete_id= $json1_res['data']['id'];
$complete_status= $json1_res['data']['status'];

	
} catch (Exception $e) {
    //echo "Error: $e";
}

if($complete_status =='Completed'){
	
include('data6rst.php');
	$update1 = $db->prepare('UPDATE payment_rapyd set payout_status=:payout_status where payout_id = :payout_id and creator_id = :creator_id');
$update1->execute(array(
			':payout_status' => 'Completed', 
			':creator_id' => $creator_id,
			':payout_id' => $payout_id
    ));
	
}

if($update1){

echo 1;
}else{

echo 0;
}






?>


