
<?php
error_reporting(0);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
//set_time_limit(300);



$timing = time();
$creator_id = strip_tags($_POST['creator_id1']);
$s_description= strip_tags($_POST['s_description']);
$s_merchant_reference_id= strip_tags($_POST['s_merchant_reference_id']);
$s_payout_currency= strip_tags($_POST['s_payout_currency']);
$s_payout_method_type= strip_tags($_POST['s_payout_method_type']);
$s_name= strip_tags($_POST['s_name']);
$s_address= strip_tags($_POST['s_address']);
$s_city= strip_tags($_POST['s_city']);
$s_state= strip_tags($_POST['s_state']);
$s_date_of_birth= strip_tags($_POST['s_date_of_birth']);
$s_postcode= strip_tags($_POST['s_postcode']);
$s_phonenumber= strip_tags($_POST['s_phonenumber']);
$s_remitter_account_type= strip_tags($_POST['s_remitter_account_type']);
$s_source_of_income= strip_tags($_POST['s_source_of_income']);
$s_identification_type= strip_tags($_POST['s_identification_type']);
$s_identification_value= strip_tags($_POST['s_identification_value']);
$s_purpose_code= strip_tags($_POST['s_purpose_code']);
$s_account_number= strip_tags($_POST['s_account_number']);
$s_beneficiary_relationship= strip_tags($_POST['s_beneficiary_relationship']);
$s_sender_country= strip_tags($_POST['s_sender_country']);
$s_sender_currency= strip_tags($_POST['s_sender_currency']);
$s_sender_entity_type= strip_tags($_POST['s_sender_entity_type']);

include('data6rst.php');

$update1 = $db->prepare('UPDATE payers_bankinfo set 
s_description=:s_description,
s_merchant_reference_id=:s_merchant_reference_id,
s_payout_currency=:s_payout_currency,
s_payout_method_type=:s_payout_method_type,
s_name=:s_name,
s_address=:s_address,
s_city=:s_city,
s_state=:s_state,
s_date_of_birth=:s_date_of_birth,
s_postcode=:s_postcode,
s_phonenumber=:s_phonenumber,
s_remitter_account_type=:s_remitter_account_type,
s_source_of_income=:s_source_of_income,
s_identification_type=:s_identification_type,
s_identification_value=:s_identification_value,
s_purpose_code=:s_purpose_code,
s_account_number=:s_account_number,
s_beneficiary_relationship=:s_beneficiary_relationship,
s_sender_country=:s_sender_country,
s_sender_currency=:s_sender_currency,
s_sender_entity_type=:s_sender_entity_type, status=:status, timing=:timing where creator_id = :creator_id');

$update1->execute(array(
':creator_id' => $creator_id,
':s_description' => $s_description,
':s_merchant_reference_id' => $s_merchant_reference_id,
':s_payout_currency' => $s_payout_currency,
':s_payout_method_type' => $s_payout_method_type,
':s_name' => $s_name,
':s_address' => $s_address,
':s_city' => $s_city,
':s_state' => $s_state,
':s_date_of_birth' => $s_date_of_birth,
':s_postcode' => $s_postcode,
':s_phonenumber' => $s_phonenumber,
':s_remitter_account_type' => $s_remitter_account_type,
':s_source_of_income' => $s_source_of_income,
':s_identification_type' => $s_identification_type,
':s_identification_value' => $s_identification_value,
':s_purpose_code' => $s_purpose_code,
':s_account_number' => $s_account_number,
':s_beneficiary_relationship' => $s_beneficiary_relationship,
':s_sender_country' => $s_sender_country,
':s_sender_currency' => $s_sender_currency,
':s_sender_entity_type' => $s_sender_entity_type,
':status' =>'ok',
':timing' =>$timing
    ));




if($update1){
	//echo "<div style='color:white;background:green;padding:10px;'>Bank Info Updates Successful. Redirecting in 1 seconds</div>";
	echo "<script>
	alert('Bank Info Updates Successful');
window.setTimeout(function() {
    window.location.href = 'bank_info_update.html';
}, 1000);
</script><br><br>";

}else{
	echo "<div style='color:white;background:red;padding:10px;'>Bank Info Updates Failed</div>";
	
}






?>