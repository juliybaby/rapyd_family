<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
set_time_limit(300);




include('data6rst.php');

$queryid = $_POST['queryid_sal'];
$page_row_call = $_POST['page_row_call_sal'];


$owner_id= strip_tags($_POST['owner_id']);


$res= $db->prepare("SELECT count(*) as totalcount FROM salary_pay where creator_id=:creator_id order by id");
$res->execute(array(':creator_id' =>$owner_id));
$t_row = $res->fetch();
$totalcount = $t_row['totalcount'];

if($totalcount == 0){
//echo "<div style='background:red;color:white;padding:10px;border:none;'>This Employee has not been Paid yet.. <b></b></div>";
echo 11;
exit();
}

$result = $db->prepare("SELECT * FROM salary_pay where creator_id=:creator_id order by id DESC limit :row1, :rowpage");
$result->bindValue(':rowpage', (int) trim($page_row_call), PDO::PARAM_INT);
$result->bindValue(':row1', (int) trim($queryid), PDO::PARAM_INT);
//$result->bindValue(':userid', trim($owner_id), PDO::PARAM_STR);
$result->bindValue(':creator_id', trim($owner_id), PDO::PARAM_INT);
$result->execute();

$count_post = $result->rowCount();


$result_arr = array();
$result_arr[] = array("allcount" => $totalcount);
while($row = $result->fetch()){

/*
create table salary_pay(
id int primar key auto_increment,
userid varchar(50),
photo varchar(200),
fullname varchar(70),
department varchar(50),
salary_amount varchar(50),
salary_month varchar(50),
timing varchar(50),
calendar_month varchar(50),
calendar_date varchar(50),
payment_method varchar(50),
creator_id varchar(20),
data varchar(50));
*/

$id = htmlentities(htmlentities($row['id'], ENT_QUOTES, "UTF-8"));
$userid = htmlentities(htmlentities($row['userid'], ENT_QUOTES, "UTF-8"));
$photo = htmlentities(htmlentities($row['photo'], ENT_QUOTES, "UTF-8"));
$fullname = htmlentities(htmlentities($row['fullname'], ENT_QUOTES, "UTF-8"));
$department = htmlentities(htmlentities($row['department'], ENT_QUOTES, "UTF-8"));
$salary_amount = htmlentities(htmlentities($row['salary_amount'], ENT_QUOTES, "UTF-8"));
$salary_month = htmlentities(htmlentities($row['salary_month'], ENT_QUOTES, "UTF-8"));
$timing = htmlentities(htmlentities($row['timing'], ENT_QUOTES, "UTF-8"));
$payment_method = htmlentities(htmlentities($row['payment_method'], ENT_QUOTES, "UTF-8"));

$result_arr[] = array(
"id" => $id,
"userid " => $userid ,
"photo" => $photo,
"fullname" => $fullname,
"department" => $department,
"salary_amount" => $salary_amount,
"salary_month" => $salary_month,
"timing" => $timing,
"payment_method" => $payment_method
);


}
echo json_encode($result_arr);