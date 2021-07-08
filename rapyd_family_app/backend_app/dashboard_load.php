<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
set_time_limit(300);




include('data6rst.php');

$queryid = $_POST['queryid'];
$page_row_call = $_POST['page_row_call'];


$owner_id= strip_tags($_POST['owner_id']);


$res= $db->prepare("SELECT count(*) as totalcount FROM families where creator_id=:creator_id order by id");
$res->execute(array(':creator_id' =>$owner_id));
$t_row = $res->fetch();
$totalcount = $t_row['totalcount'];

if($totalcount == 0){
//echo "<div style='background:red;color:white;padding:10px;border:none;'>No Employee has been added yet.. <b></b></div>";
echo 11;
exit();
}

$result = $db->prepare("SELECT * FROM families where creator_id=:creator_id order by id DESC limit :row1, :rowpage");
$result->bindValue(':rowpage', (int) trim($page_row_call), PDO::PARAM_INT);
$result->bindValue(':row1', (int) trim($queryid), PDO::PARAM_INT);
//$result->bindValue(':userid', trim($owner_id), PDO::PARAM_STR);
$result->bindValue(':creator_id', trim($owner_id), PDO::PARAM_INT);
$result->execute();

$count_post = $result->rowCount();


$result_arr = array();
$result_arr[] = array("allcount" => $totalcount);
while($row = $result->fetch()){


//(fullname,email,photo,department,phone_no,created_time,timer,lastdate_pay,lastdate_time,payment_status,user_token)

$id = htmlentities(htmlentities($row['id'], ENT_QUOTES, "UTF-8"));
$fullname = htmlentities(htmlentities($row['fullname'], ENT_QUOTES, "UTF-8"));
$email = htmlentities(htmlentities($row['email'], ENT_QUOTES, "UTF-8"));
$phone_no = htmlentities(htmlentities($row['phone_no'], ENT_QUOTES, "UTF-8"));
$photo = htmlentities(htmlentities($row['photo'], ENT_QUOTES, "UTF-8"));
$department = htmlentities(htmlentities($row['department'], ENT_QUOTES, "UTF-8"));
$created_time = htmlentities(htmlentities($row['created_time'], ENT_QUOTES, "UTF-8"));
$timer = htmlentities(htmlentities($row['timer'], ENT_QUOTES, "UTF-8"));
$user_token = htmlentities(htmlentities($row['user_token'], ENT_QUOTES, "UTF-8"));
$salary = htmlentities(htmlentities($row['salary'], ENT_QUOTES, "UTF-8"));
$first_name = htmlentities(htmlentities($row['first_name'], ENT_QUOTES, "UTF-8"));
$last_name= htmlentities(htmlentities($row['last_name'], ENT_QUOTES, "UTF-8"));
$wallet_id = htmlentities(htmlentities($row['wallet_id'], ENT_QUOTES, "UTF-8"));


$b_name = htmlentities(htmlentities($row['b_name'], ENT_QUOTES, "UTF-8"));
$b_address = htmlentities(htmlentities($row['b_address'], ENT_QUOTES, "UTF-8"));
$b_email = htmlentities(htmlentities($row['b_email'], ENT_QUOTES, "UTF-8"));
$b_country = htmlentities(htmlentities($row['b_country'], ENT_QUOTES, "UTF-8"));
$b_city = htmlentities(htmlentities($row['b_city'], ENT_QUOTES, "UTF-8"));
$b_postcode = htmlentities(htmlentities($row['b_postcode'], ENT_QUOTES, "UTF-8"));
$b_account_number = htmlentities(htmlentities($row['b_account_number'], ENT_QUOTES, "UTF-8"));
$bank_name = htmlentities(htmlentities($row['bank_name'], ENT_QUOTES, "UTF-8"));
$b_state = htmlentities(htmlentities($row['b_state'], ENT_QUOTES, "UTF-8"));
$b_identification_type = htmlentities(htmlentities($row['b_identification_type'], ENT_QUOTES, "UTF-8"));
$b_identification_value = htmlentities(htmlentities($row['b_identification_value'], ENT_QUOTES, "UTF-8"));
$b_bic_swift = htmlentities(htmlentities($row['b_bic_swift'], ENT_QUOTES, "UTF-8"));
$b_ach_code = htmlentities(htmlentities($row['b_ach_code'], ENT_QUOTES, "UTF-8"));
$b_beneficiary_country = htmlentities(htmlentities($row['b_beneficiary_country'], ENT_QUOTES, "UTF-8"));
$b_beneficiary_entity_type = htmlentities(htmlentities($row['b_beneficiary_entity_type'], ENT_QUOTES, "UTF-8"));




$result_arr[] = array(
"id" => $id,
"fullname" => $fullname,
"email" => $email,
"phone_no" => $phone_no,
"photo" => $photo,
"department" => $department,
"created_time" => $created_time,
"timer" => $timer,
"user_token" => $user_token,
"salary" => $salary,
"first_name" => $first_name,
"last_name" => $last_name,
"wallet_id" => $wallet_id,

"b_name" => $b_name,
"b_address" => $b_address,
"b_email" => $b_email,
"b_country" => $b_country,
"b_city" => $b_city,
"b_postcode" => $b_postcode,
"b_account_number" => $b_account_number,
"bank_name" => $bank_name,
"b_state" => $b_state,
"b_identification_type" => $b_identification_type,
"b_identification_value" => $b_identification_value,
"b_bic_swift" => $b_bic_swift,
"b_ach_code" => $b_ach_code,
"b_beneficiary_country" => $b_beneficiary_country,
"b_beneficiary_entity_type" => $b_beneficiary_entity_type

);


}
echo json_encode($result_arr);