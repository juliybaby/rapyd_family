<?php
error_reporting(0);
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//ini_set('max_execution_time', 300); //300 seconds = 5 minutes
// temporarly extend time limit
//set_time_limit(300);




$creator_id=strip_tags($_POST['idxc']);

require('data6rst.php');
$result = $db->prepare('SELECT * FROM updates_data_rapyd  where creator_id =:creator_id');
		$result->execute(array(
':creator_id' => $creator_id
    ));
$nosofrows = $result->rowCount();
$rec_List1 = $nosofrows;


if($rec_List1  == 0){

echo "<div style='background:red;color:white;padding:10px;border:none'>This Employeer has not Updated Anything Yet. Try Adding Employees, Create and Fund Your Wallets. Pay your Employees.</div>";
}

while($v1 = $result->fetch()){

	 

$id = $v1['id'];
$total_fund_fund = $v1['total_fund_fund'];
$total_fund_spend= $v1['total_fund_spend'];
$total_employee = $v1['total_employee'];
$total_fund_available =  $v1['total_fund_available'];

?>

<style>
.cx1{
 color:black;
padding:10px;
background:#ddd;
font-size:20px;
text-align:center;
border-radius:20%;
}
.cx1:hover{ 
color:black;
background:orange
}

</style>
<div class="col-sm-12 notify_content_css" >



<div class='col-sm-4 cx1'>
<b >Total Amount Funded to Wallets So Far: <br><?php echo $total_fund_fund; ?> (USD)</b><br>
</div>

<div class='col-sm-4 cx1'>
<b >Total Amount Spent/Sent on so Far: <br><?php echo $total_fund_spend; ?> (USD)</b><br>
</div>

<div class='col-sm-4 cx1'>
<b>Total No. of Recipients: <br><?php echo $total_employee; ?></b><br>
</div>

</div>
<?php
}
?>

