
<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
set_time_limit(300);


$timing = time();


$ux_reason = strip_tags($_POST['ux_reason1']);
$ux_amount = strip_tags($_POST['ux_amount1']);


$employeers_wallet_id = strip_tags($_POST['employeers_wallet_id']);
$employees_wallet_id = strip_tags($_POST['employees_wallet_id']);

$creator_id = strip_tags($_POST['creator_id1']);
$user_token = strip_tags($_POST['ee_token']);
$userid = strip_tags($_POST['ee_uid']);
$b_date = strip_tags($_POST['b_date1']);

$s_wallet_id = $employeers_wallet_id;

$str_date =$b_date;
$ff1 = explode('-', $str_date);
$yearing1 =$ff1[0];
$monthing1= $ff1[1];
$daying1= $ff1[2];


$string = $monthing1;
 
//Get the first character.
$firstCharacter = $string[0];

//Get the second character.
$secondCharacter = $string[1];

if($firstCharacter ==0){
$report_month = $secondCharacter;
}

if($firstCharacter !=0){
$report_month = $monthing1;
}


$timer = time();
// get balance

include('data6rst.php');


// get employees salary
	
$resulta = $db->prepare('SELECT * FROM families where creator_id = :creator_id and user_token= :user_token and id=:id');
		$resulta->execute(array(
			':creator_id' => $creator_id,
			':user_token' => $user_token ,
			':id' => $userid 
    ));
$nosofrowsa = $resulta->rowCount();
$rec_List1a = $nosofrowsa;
$rowsa = $resulta->fetch();
//$b_salary = $rowsa['salary'];

$recipient_id = $rowsa['email'];

$b_salary = $ux_amount;

include('utilities.php');


try {
    $object1 = make_request('get', "/v1/user/$s_wallet_id/accounts" );
    //var_dump($object1);
$json1 = json_decode(json_encode($object1), true);


$json2 = json_encode($json1, true);
print_r($json1);

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


if($status_success1 ==''){

echo "<script>alert('There is a Problem Checking Wallets Balance First. Please Ensure there is Internet Connections');</script>";
echo "<div style='background:red;color:white;padding:10px;border-none;'>There is a Problem Checking Wallets Balance First. Please Ensure there is Internet Connections</div><br>";

 //print_r($json);
	 exit();	
}

// check if there is enough balance before making payments
if($balance < $b_salary){


echo "<style>
.fs_css{background:navy;color:white;padding:10px;}
.fs_css:hover{background:orange;color:black;}
</style>";

echo "<script>alert('Insufficient Fund in this Wallets.... The balance in this wallets is ($balance USD) but you are trying to Transfer ($b_salary USD). Please fund your Wallets in this App');</script>";
echo "<div style='background:red;color:white;padding:10px;border-none;'>Insufficient Fund in this Wallets...... <br>The balance in this wallets is ($balance USD) but you are trying to Transfer ($b_salary USD).
<br> Please fund your Wallets by clicking the button below<br><br>
<a class='fs_css' href='wallets_create_fund.html'>Fund Your Wallets</a>
</div><br>";




//echo "<script>alert('Insufficient Fund in this Wallets');</script>";
//echo "<div style='background:red;color:white;padding:10px;border-none;'>Insufficient Fund in this Wallets</div><br>";
//print_r($json);
	 exit();	
}




// proceed with Payments Transfer

	$body = [
    'amount' => "$b_salary",
    'currency' => 'USD',
    'source_ewallet' => "$employeers_wallet_id",
    'destination_ewallet' => "$employees_wallet_id"
];

try {
    $object = make_request('post', '/v1/account/transfer', $body);
    //var_dump($object);


$json1_res = json_decode(json_encode($object), true);

$json2_res = json_encode($json1_res, true);
print_r($json1_res);

$transfer_success = $json1_res['status']['status'];
$transfer_id= $json1_res['data']['id'];
$transfer_status= $json1_res['data']['status'];



} catch(Exception $e) {
    echo "Error: $e";
}


if($transfer_status =='PEN'){

$resulta = $db->prepare('SELECT * FROM families where creator_id = :creator_id and user_token= :user_token and id=:id');

		$resulta->execute(array(
			':creator_id' => $creator_id,
			':user_token' => $user_token ,
			':id' => $userid 
    ));
$nosofrowsa = $resulta->rowCount();
$rec_List1a = $nosofrowsa;
/*
if($rec_List1a  == 0){
echo "<div style='background:red;color:white;padding:10px;border:none'>Users Info not Found.</div>";
}
*/
$rowsa = $resulta->fetch();
$photo = $rowsa['photo'];
$department = $rowsa['department'];
$user_ewallet_id = $rowsa['wallet_id'];
$fullname = $rowsa['fullname'];




$res = $db->prepare('SELECT * FROM users where id = :id');

		$res->execute(array(
			':id' => $creator_id ));
$r = $res->fetch();
echo $sender_photo = $r['photo'];
echo $sender_name = $r['fullname'];
echo $sender_relation= '0';




$statement = $db->prepare('INSERT INTO payment_rapyd
(photo,fullname,department,user_token,user_id,payout_id,payout_status,timing,payment_type1,payment_type2,salary_amount,month_date,
month_period,creator_id,user_ewallet_id,reason,amount_pay,recipient_id,sender_name,sender_photo,sender_relation)
 
                          values
(:photo,:fullname,:department,:user_token,:user_id,:payout_id,:payout_status,:timing,:payment_type1,:payment_type2,:salary_amount,:month_date,
:month_period,:creator_id,:user_ewallet_id,:reason,:amount_pay,:recipient_id,:sender_name,:sender_photo,:sender_relation)');

$statement->execute(array( 

':photo' => $photo,
':fullname' => $fullname,
':department' => $department,		
':user_token' => $user_token,
':user_id' => $userid,
':payout_id' => $transfer_id,
':payout_status' => $transfer_status,
':timing' => $timer,
':payment_type1' => 'Wallet',
':payment_type2' =>'Wallet Fund Transfer',
':salary_amount' =>$b_salary,
':month_date' =>$report_month,
':month_period' =>$b_date,
':creator_id' =>$creator_id,
':user_ewallet_id' => $user_ewallet_id,
':reason' => $ux_reason,
':amount_pay' => $ux_amount,
':recipient_id' => $recipient_id,
':sender_name' => $sender_name,
':sender_photo' => $sender_photo,
':sender_relation' => $sender_relation
));

$id = $db->lastInsertId();	


//updates Employeers Wallets info
$final_balance = $balance  - $b_salary;

$update1 = $db->prepare('UPDATE wallets set fund=:fund where wallet_id = :wallet_id and creator_id = :creator_id');
$update1->execute(array(
			':wallet_id' => $employeers_wallet_id, 
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
$ftotal = $total_fund_spend + $b_salary;

//$ftotal1 = $total_fund_spend + $b_salary;

//update total spent
$update1 = $db->prepare('UPDATE updates_data_rapyd set total_fund_spend=:total_fund_spend where creator_id = :creator_id');
$update1->execute(array(
			':creator_id' => $creator_id,
			':total_fund_spend' => $ftotal 
    ));

}


if($update1){
	//echo "<div style='color:white;background:green;padding:10px;'>Fund Transfer Successful. Redirecting in 1 seconds</div>";
	echo "<script>
	alert('Fund Transfer Successful');
window.setTimeout(function() {
    //window.location.href = 'bank_info_update.html';
	//location.reload();
	window.location.href = window.location.href;
}, 1000);
</script><br><br>";

}else{
	echo "<div style='color:white;background:red;padding:10px;'>Bank Info Updates Failed</div>";
	
}






?>