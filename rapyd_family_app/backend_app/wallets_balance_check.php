
<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
//set_time_limit(300);


$timing = time();
$creator_id = strip_tags($_POST['c_id']);
$walletid_call2_wallets= strip_tags($_POST['w_id']);



// get balance

include('data6rst.php');
include('utilities.php');

try {
    $object1 = make_request('get', "/v1/user/$walletid_call2_wallets/accounts" );
    //var_dump($object1);
$json1 = json_decode(json_encode($object1), true);


$json2 = json_encode($json1, true);
//print_r($json2);

$status_success1 = $json1['status']['status'];
$da= $json1['data'];

if($da==[]){
echo "<div style='color:white;background:red;padding:10px;'>Wallets is Empty</div>";
$balance= '0';
}else{
$balance= $json1['data'][0]['balance'];
echo "<div style='color:white;background:green;padding:10px;'>Your Balance is: $balance(USD)</div>";

}



} catch(Exception $e) {
    echo "Error: $e";
}

if($status_success1 ==''){
	echo "<script>
	alert('Please Ensure there is Internet Connection and Try Again');
	</script>";
	
echo "<div style='color:white;background:red;padding:10px;'>Please Ensure there is Internet Connection and Try Again</div>";	
exit();	
}


$update1 = $db->prepare('UPDATE wallets set fund=:fund where wallet_id = :wallet_id and creator_id = :creator_id');
$update1->execute(array(
			':wallet_id' => $walletid_call2_wallets, 
			':creator_id' => $creator_id,
			':fund' => $balance
    ));


if($update1){
	echo "<script>
	alert('Alert Your Balance is: $balance(USD)');
	window.location.href = window.location.href;
/*	
window.setTimeout(function() {
    window.location.href = 'wallets_create_fund.html';
}, 1000);
*/
</script><br><br>";

}else{
	echo "<div style='color:white;background:red;padding:10px;'>Wallet Balance Checking Failed</div>";
	
}






?>