<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
set_time_limit(300);


include('data6rst.php');

$queryid = $_POST['queryid_wallets'];
$page_row_call = $_POST['page_row_call_wallets'];


$owner_id= strip_tags($_POST['owner_id']);


$res= $db->prepare("SELECT count(*) as totalcount FROM wallets order by id");
$res->execute(array());
$t_row = $res->fetch();
$totalcount = $t_row['totalcount'];

if($totalcount == 0){
//echo "<div style='background:red;color:white;padding:10px;border:none;'>No Wallets has been created yet.. <b></b></div>";
echo 11;
exit();
}

$result = $db->prepare("SELECT * FROM wallets where creator_id=:creator_id order by id DESC limit :row1, :rowpage");
$result->bindValue(':rowpage', (int) trim($page_row_call), PDO::PARAM_INT);
$result->bindValue(':row1', (int) trim($queryid), PDO::PARAM_INT);
//$result->bindValue(':userid', trim($owner_id), PDO::PARAM_STR);
$result->bindValue(':creator_id', trim($owner_id), PDO::PARAM_INT);
$result->execute();

$count_post = $result->rowCount();


$result_arr = array();
$result_arr[] = array("allcount" => $totalcount);
while($row = $result->fetch()){


$id = htmlentities(htmlentities($row['id'], ENT_QUOTES, "UTF-8"));
$phone_number = htmlentities(htmlentities($row['phone_number'], ENT_QUOTES, "UTF-8"));
$email = htmlentities(htmlentities($row['email'], ENT_QUOTES, "UTF-8"));
$last_name = htmlentities(htmlentities($row['last_name'], ENT_QUOTES, "UTF-8"));
$first_name = htmlentities(htmlentities($row['first_name'], ENT_QUOTES, "UTF-8"));
$wallet_id = htmlentities(htmlentities($row['wallet_id'], ENT_QUOTES, "UTF-8"));
$timer = htmlentities(htmlentities($row['timing'], ENT_QUOTES, "UTF-8"));
$fund = htmlentities(htmlentities($row['fund'], ENT_QUOTES, "UTF-8"));
$fund_time = htmlentities(htmlentities($row['fund_time'], ENT_QUOTES, "UTF-8"));
$creator_id = htmlentities(htmlentities($row['creator_id'], ENT_QUOTES, "UTF-8"));


$result_arr[] = array(
"id" => $id,
"phone_number" => $phone_number,
"email" => $email,
"last_name" => $last_name,
"first_name" => $first_name,
"wallet_id" => $wallet_id,
"timer" => $timer,
"fund" => $fund,
"fund_time" => $fund_time,
"creator_id" => $creator_id
);


}
echo json_encode($result_arr);