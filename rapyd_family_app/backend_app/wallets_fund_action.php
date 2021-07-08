
<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
//set_time_limit(300);


$timing = time();
$token1= md5(uniqid());
$token2 = time();
$token = $token1.$token2;


$creator_id = strip_tags($_POST['creator_id1']);
$amount1= strip_tags($_POST['amount1']);
$currency1= strip_tags($_POST['currency1']);

$description1 = strip_tags($_POST['description1']);
$name1= strip_tags($_POST['name1']);
$number1= strip_tags($_POST['number1']);

$expiration_month1 = strip_tags($_POST['expiration_month1']);
$expiration_year1= strip_tags($_POST['expiration_year1']);
$cvv1= strip_tags($_POST['cvv1']);
$walletid_call2_wallets= strip_tags($_POST['walletid_call2_wallets']); 



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
//echo "Wallets is empty";
$balance= '0';
}else{

//echo "<div style='color:white;background:green;padding:10px;'>Balance Found</div>";
$balance= $json1['data'][0]['balance'];
}



} catch(Exception $e) {
    echo "Error: $e";
}



// make payments now via RAPYD Collect


$body = [
    'receipt_email' => 'johndow@rapyd.net',
     "amount"=> "$amount1",
    "currency"=> "$currency1",
    "description"=> "$description1",

  "ewallets"=> [
[
            "ewallet"=> "$walletid_call2_wallets",
            "percentage"=> 100
        
   ] 
],


"payment_method" => [
    "type"=> "is_visa_card",
    "fields"=> [
        "name"=> "Test User",
        "number"=> "4111111111111111",
        "expiration_month"=> "08",
        "expiration_year"=> "24",
        "cvv"=> "789"
    ]
    ],
];

try {
    $object2a = make_request('post', '/v1/payments', $body);
$json2a = json_decode(json_encode($object2a), true);


$json3a = json_encode($json2a, true);
print_r($json2a);

$success = $json2a['status']['status'];
$payment_id= $json2a['data']['id'];
$amount= $json2a['data']['amount'];
$final_balance = $balance  + $amount;




$update1 = $db->prepare('UPDATE wallets set fund=:fund where wallet_id = :wallet_id and creator_id = :creator_id');
$update1->execute(array(
			':wallet_id' => $walletid_call2_wallets, 
			':creator_id' => $creator_id,
			':fund' => $final_balance
    ));

//query updates_data_rapyd tables


$result = $db->prepare('SELECT * FROM updates_data_rapyd where creator_id = :creator_id');

		$result->execute(array(
			':creator_id' => $creator_id 
    ));
$nosofrows = $result->rowCount();
$rec_List1 = $nosofrows;
if($rec_List1  == 0){
echo "<div style='background:red;color:white;padding:10px;border:none'>You will need to create wallet First.</div>";

}

$rows = $result->fetch();
$id = $rows['id'];
$total_fund_fund = $rows['total_fund_fund'];
$total_fund_spend = $rows['total_fund_spend'];
$total_fund_available = $rows['total_fund_available'];
$ftotal = $total_fund_fund + $amount1;

$update1 = $db->prepare('UPDATE updates_data_rapyd set total_fund_fund=:total_fund_fund where creator_id = :creator_id');
$update1->execute(array(
			':creator_id' => $creator_id,
			':total_fund_fund' => $ftotal 
    ));
	
	


} catch(Exception $e) {
    echo "Error: $e";
}


if($update1){
	//echo "<div style='color:white;background:green;padding:10px;'>Wallet Funding Successful. Redirecting in 1 seconds</div>";
	echo "<script>
	alert('Wallet Funding Successful');
window.setTimeout(function() {
    window.location.href = 'wallets_create_fund.html';
}, 1000);
</script><br><br>";

}else{
	echo "<div style='color:white;background:red;padding:10px;'>Wallet Funding Failed</div>";
	
}






?>