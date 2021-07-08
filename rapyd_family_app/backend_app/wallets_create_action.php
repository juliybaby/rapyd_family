
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

$app ='myapp';
$creator_id = strip_tags($_POST['creator_id']);
$first_name= strip_tags($_POST['first_name']);
$last_name= strip_tags($_POST['last_name']);


$email= strip_tags($_POST['email_w']);
$phone_number= strip_tags($_POST['phone_number']);

$mothers_name= strip_tags($_POST['mothers_name']);
$contact_type= strip_tags($_POST['contact_type']);
$identification_type= strip_tags($_POST['identification_type']);
$identification_number= strip_tags($_POST['identification_number']);
$date_of_birth= strip_tags($_POST['date_of_birth']);
$country= strip_tags($_POST['country']);

$fname = "$last_name $first_name";



$ewallet_reference_id= "$first_name-$last_name-$timing-$app";
$full_name = "$first_name $last_name";

include('data6rst.php');
include('utilities.php');
$body = [
    'first_name' => "$first_name",
    'last_name' => "$last_name",
    'email' => '',
    'ewallet_reference_id' => "$ewallet_reference_id",
    'metadata' => [
        'merchant_defined' => true
    ],
    'phone_number' => '',
    'type' => 'person',
    'contact' => [
        'phone_number' => "$phone_number",
        'email' => "$email",
        'first_name' => "$first_name",
        'last_name' => "$last_name",
        'mothers_name' => "$mothers_name",
        'contact_type' => "$contact_type",
        'address' => [
            'name' => "$fname",
            'line_1' => '123 Main Street',
            'line_2' => '',
            'line_3' => '',
            'city' => 'Anytown',
            'state' => 'NYAA',
            'country' => "$country",
            'zip' => '12345',
            'phone_number' => "$phone_number",
            'metadata' => [],
            'canton' => '',
            'district' => '',
        ],
        'identification_type' => "$identification_type",
        'identification_number' => "$identification_number",
        'date_of_birth' => "$date_of_birth",
        'country' => "$country",
        'metadata' => [
                'merchant_defined' => true
        ],
      ],
    ];

try {
    $object = make_request('post', '/v1/user', $body);
$json = json_decode(json_encode($object), true);

//$json = json_encode($object, true);

print_r($json);


$status_success = $json['status']['status'];
$wallet_id= $json['data']['id'];
$account_status = 'ACT';

if($status_success !='SUCCESS'){
	echo "<div style='background:red;color:white;padding:10px;border-none;'>There is a Problem creating your Wallets</div><br>";

	 print_r($json);
	 exit();
}
// start for each if for success
if($status_success =='SUCCESS'){

$statement = $db->prepare('INSERT INTO wallets
(phone_number,email,last_name,first_name,wallet_id,account_status,ewallet_reference_id,timing,fund,fund_time,creator_id)
                          values
(:phone_number,:email,:last_name,:first_name,:wallet_id,:account_status,:ewallet_reference_id,:timing,:fund,:fund_time,:creator_id)');

$statement->execute(array( 
':phone_number' => $phone_number,
':email' => $email,		
':last_name' => $last_name,
':first_name' => $first_name,
':wallet_id' => $wallet_id,
':account_status' =>$account_status,
':ewallet_reference_id' => $ewallet_reference_id,
':timing' => $timing,
':fund' =>'0.0',
':fund_time' =>'00:00:00',
':creator_id' =>$creator_id
));


echo "<div style='background:green;color:white;padding:10px;border-none;'>Wallets Created Successfully. Redirecting in a seconds</div><br>";

echo "<script>
alert('Wallets Created Successfully.');
window.setTimeout(function() {
    window.location.href = 'wallets_create_fund.html';
}, 1000);
</script><br><br>";


print_r($json);


}
// end if for success


} catch(Exception $e) {


    echo "Error: $e";
}



?>