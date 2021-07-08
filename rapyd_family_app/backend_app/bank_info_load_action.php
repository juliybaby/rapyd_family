<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
//set_time_limit(300);

$creator_id=strip_tags($_POST['creator_id2']);

include('settings_url.php');
$image_url1= $image_url;
require('data6rst.php');
$result = $db->prepare('SELECT * FROM payers_bankinfo where creator_id =:creator_id');
		$result->execute(array(
':creator_id' => $creator_id
    ));
$nosofrows = $result->rowCount();
$rec_List1 = $nosofrows;

/*
if($rec_List1  == 0){
echo "<div style='background:red;color:white;padding:10px;border:none'>This User Info Does not Exist.</div>";
}
*/
//while($v1 = $result->fetch()){

$v1 = $result->fetch();
$id = $v1['id'];
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
$status = $v1['status'];
$timing = $v1['timing'];


if($status  != 'ok'){
echo "<div style='background:red;color:white;padding:10px;border:none'>Hey Employeer. Please Update your Banking Info to Facilitates Your
Employees Payout to their Bank Accounts. (Scroll Down left and Click Update Bank Info Button)</div>";
exit();
}

?>

<div class="col-sm-12 notify_content_css" >
<div  style="color:black;padding:10px;background:#ddd">


<b>Description:</b> <?php echo $s_description; ?><br>
<b>Merchant_reference_id:</b> <?php echo $s_merchant_reference_id; ?><br>
<b>Payout_currency:</b> <?php echo $s_payout_currency; ?><br>
<b>Payout_method_type:</b> <?php echo $s_payout_method_type; ?><br>

<b>Name:</b> <?php echo $s_name; ?><br>
<b>Address:</b> <?php echo $s_address; ?><br>
<b>City:</b> <?php echo $s_city; ?><br>
<b>State:</b> <?php echo $s_state; ?><br>

<b>Date_of_birth:</b> <?php echo $s_date_of_birth; ?><br>
<b>Postcode:</b> <?php echo $s_postcode; ?><br>
<b>Phonenumber:</b> <?php echo $s_phonenumber; ?><br>
<b>Remitter_account_type:</b> <?php echo $s_remitter_account_type; ?><br>

<b>Source_of_income:</b> <?php echo $s_source_of_income; ?><br>
<b>Identification_type:</b> <?php echo $s_identification_type; ?><br>
<b>Identification_value:</b> <?php echo $s_identification_value; ?><br>
<b>Purpose_code:</b> <?php echo $s_purpose_code; ?><br>

<b>Account_number:</b> <?php echo $s_account_number; ?><br>
<b>Beneficiary_relationship:</b> <?php echo $s_beneficiary_relationship; ?><br>
<b>Sender_country:</b> <?php echo $s_sender_country; ?><br>
<b>Sender_currency:</b> <?php echo $s_sender_currency; ?><br>


<b>Sender_entity_type:</b> <?php echo $s_sender_entity_type; ?><br>


<span style='color:green;font-size:18px'><b>Last Updated Time: </b> <span data-livestamp="<?php echo $timing;?>"></span></span> 


<br>

</div></div>
<?php
//}
?>

