<?php 

error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include('data6rst.php');
 

	$creator_id = strip_tags($_POST['creator_id']);
	$user_id = strip_tags($_POST['n_uid']);
	$user_token = strip_tags($_POST['n_token']);
	
	// get employees wallet id
	
$resulta = $db->prepare('SELECT * FROM families where creator_id = :creator_id and user_token= :user_token and id=:id');
		$resulta->execute(array(
			':creator_id' => $creator_id,
			':user_token' => $user_token ,
			':id' => $user_id 
    ));
$nosofrowsa = $resulta->rowCount();
$rec_List1a = $nosofrowsa;
$rowsa = $resulta->fetch();
$employees_ewallet_id = $rowsa['wallet_id'];


	

	//get employeers wallet id
$result = $db->prepare('SELECT * FROM wallets WHERE creator_id=:creator_id');
$result->execute(array(
			':creator_id' => $creator_id
    ));

$res = array();
foreach($result as $vs){
		$res[] = array(
				"id" => $vs['id'],
				"wallet_id" => $vs['wallet_id'],
				"employee_wallet_id" =>$employees_ewallet_id
			);
	}

	echo json_encode($res);
	exit;

