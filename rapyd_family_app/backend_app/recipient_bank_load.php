<?php 

error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include('data6rst.php');

$creator_id = strip_tags($_POST['creator_id']);
$e_uid = strip_tags($_POST['e_uid']);
$e_token = strip_tags($_POST['e_token']);


$res = $db->prepare('SELECT * FROM payers_bankinfo WHERE creator_id=:creator_id');
$res->execute(array(
			':creator_id' => $creator_id
    ));
$v1 = $res->fetch();
$s_description = $v1['s_description'];
$s_merchant_reference_id = $v1['s_merchant_reference_id'];
$s_payout_currency = $v1['s_payout_currency'];
$s_payout_method_type = $v1['s_payout_method_type'];
$s_name = $v1['s_name'];
$s_address = $v1['s_address'];
$s_city = $v1['s_city'];
$s_state = $v1['s_state'];
$s_date_of_birth = $v1['s_date_of_birth'];
$s_postcode = $v1['s_postcode'];
$s_phonenumber = $v1['s_phonenumber'];
$s_remitter_account_type = $v1['s_remitter_account_type'];
$s_source_of_income = $v1['s_source_of_income'];
$s_identification_type = $v1['s_identification_type'];
$s_identification_value = $v1['s_identification_value'];
$s_purpose_code = $v1['s_purpose_code'];
$s_account_number = $v1['s_account_number'];
$s_beneficiary_relationship = $v1['s_beneficiary_relationship'];
$s_sender_country = $v1['s_sender_country'];
$s_sender_currency = $v1['s_sender_currency'];
$s_sender_entity_type = $v1['s_sender_entity_type'];	


$result = $db->prepare('SELECT * FROM families WHERE creator_id=:creator_id and user_token=:user_token and id=:id');
$result->execute(array(
			':creator_id' => $creator_id,
                        ':user_token' => $e_token,
':id' => $e_uid
    ));
	
$res = array();
foreach($result as $vs){
		$res[] = array(
				"id" => $vs['id'],
				"wallet_id" => $vs['wallet_id'],
				"salary" => $vs['salary'],
"b_name" => $vs['b_name'],
"b_address" => $vs['b_address'],
"b_email" => $vs['b_email'],
"b_country" => $vs['b_country'],
"b_city" => $vs['b_city'],
"b_postcode" => $vs['b_postcode'],
"b_account_number" => $vs['b_account_number'],
"bank_name" => $vs['bank_name'],
"b_state" => $vs['b_state'],
"b_identification_type" => $vs['b_identification_type'],
"b_identification_value" => $vs['b_identification_value'],
"b_bic_swift" => $vs['b_bic_swift'],
"b_ach_code" => $vs['b_ach_code'],
"b_beneficiary_country" => $vs['b_beneficiary_country'],
"b_beneficiary_entity_type" => $vs['b_beneficiary_entity_type'],
"s_description" => $s_description,
"s_merchant_reference_id" => $s_merchant_reference_id,
"s_payout_currency" => $s_payout_currency,
"s_payout_method_type" => $s_payout_method_type,
"s_name" => $s_name,
"s_address" => $s_address,
"s_city" => $s_city,
"s_state" => $s_state,
"s_date_of_birth" => $s_date_of_birth,
"s_postcode" => $s_postcode,
"s_phonenumber" => $s_phonenumber,
"s_remitter_account_type" => $s_remitter_account_type,
"s_source_of_income" => $s_source_of_income,
"s_identification_type" => $s_identification_type,
"s_identification_value" => $s_identification_value,
"s_purpose_code" => $s_purpose_code,
"s_account_number" => $s_account_number,
"s_beneficiary_relationship" => $s_beneficiary_relationship,
"s_sender_country" => $s_sender_country,
"s_sender_currency" => $s_sender_currency,
"s_sender_entity_type" => $s_sender_entity_type
			);
	}

	echo json_encode($res);
	exit;

